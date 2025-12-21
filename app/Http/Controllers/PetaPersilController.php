<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\PetaPersil;
use App\Models\Persil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaPersilController extends Controller
{

public function index(Request $request)
{
    $search = $request->search;

    $peta = PetaPersil::with(['media', 'persil'])
        ->when($search, function ($query) use ($search) {
            $query->whereHas('persil', function ($q) use ($search) {
                $q->where('kode_persil', 'like', "%{$search}%");
            })
            ->orWhere('peta_id', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(9)
        ->withQueryString(); // ⬅️ PENTING BIAR SEARCH TIDAK HILANG SAAT PAGINATION

    return view('pages.peta_persil.index', compact('peta'));
}


    public function create()
    {
$persils = Persil::orderBy('kode_persil')->get();

    return view('pages.peta_persil.create', compact('persils'));
    }

    public function store(Request $request)
{
    $request->validate([
        'persil_id'      => 'required|exists:persil,persil_id',
        'geojson'        => 'nullable|string',
        'panjang_m'      => 'nullable|numeric',
        'lebar_m'        => 'nullable|numeric',
        'dokumen_file.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    $peta = PetaPersil::create([
        'persil_id' => $request->persil_id,
        'geojson'   => $request->geojson,
        'panjang_m' => $request->panjang_m,
        'lebar_m'   => $request->lebar_m,
    ]);

    if ($request->hasFile('dokumen_file')) {
        foreach ($request->file('dokumen_file') as $file) {
            $path = $file->store('peta_persil', 'public');

            Media::create([
                'ref_table' => 'peta_persil',
                'ref_id'    => $peta->peta_id,
                'file_url'  => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }
    }

    return redirect()
        ->route('peta_persil.index')
        ->with('success', 'Peta persil berhasil disimpan.');
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'persil_id'      => 'required|exists:persil,persil_id',
            'geojson'        => 'required|string',
            'panjang_m'      => 'required|numeric',
            'lebar_m'        => 'required|numeric',
            'dokumen_file.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $peta = PetaPersil::findOrFail($id);
        $peta->update(
            $request->only(['persil_id', 'geojson', 'panjang_m', 'lebar_m'])
        );

        if ($request->hasFile('dokumen_file')) {
            foreach ($request->file('dokumen_file') as $file) {
                $path = $file->store('media', 'public');

                Media::create([
                    'ref_table' => 'peta_persil',
                    'ref_id'    => $peta->peta_id, // 🔑 WAJIB
                    'file_url'  => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('peta_persil.index')
            ->with('success', 'Peta berhasil diupdate');
    }
    public function edit($id)
    {
        $p = PetaPersil::findOrFail($id);
    $persils = Persil::orderBy('kode_persil')->get();

    return view('pages.peta_persil.edit', compact('p', 'persils'));
    }

    public function destroy($id)
    {
        $peta = PetaPersil::with('media')->findOrFail($id);

        foreach ($peta->media as $m) {
            if (Storage::disk('public')->exists($m->file_url)) {
                Storage::disk('public')->delete($m->file_url);
            }
            $m->delete();
        }

        $peta->delete();

        return redirect()->route('peta_persil.index')
            ->with('success', 'Peta berhasil dihapus');
    }
    public function destroyMedia($petaId, $mediaId)
    {
        $media = Media::where('ref_table', 'peta_persil')
            ->where('ref_id', $petaId)
            ->where('media_id', $mediaId)
            ->firstOrFail();

        // hapus file fisik
        if (Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        // hapus database
        $media->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
