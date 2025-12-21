<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Persil;
use App\Models\SengketaPersil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SengketaPersilController extends Controller
{

public function index(Request $request)
{
    $search = $request->search;

    $sengketa = SengketaPersil::with(['persil', 'media'])
        ->when($search, function ($query) use ($search) {
            $query->where('pihak_1', 'like', "%{$search}%")
                  ->orWhere('pihak_2', 'like', "%{$search}%")
                  ->orWhere('kronologi', 'like', "%{$search}%")
                  ->orWhereHas('persil', function ($q) use ($search) {
                      $q->where('kode_persil', 'like', "%{$search}%");
                  });
        })
        ->latest()
        ->paginate(9)        // ⬅️ pagination aktif
        ->withQueryString(); // ⬅️ search tidak hilang saat pindah halaman

    return view('pages.sengketa_persil.index', compact('sengketa'));
}


    public function create()
    {
        $persils = Persil::all();
        return view('pages.sengketa_persil.create', compact('persils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persil_id'    => 'required|exists:persil,persil_id',
            'pihak_1'      => 'required|string|max:255',
            'pihak_2'      => 'required|string|max:255',
            'kronologi'    => 'nullable|string',
            'status'       => 'required|string',
            'penyelesaian' => 'nullable|string',
            'bukti_file.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $s = SengketaPersil::create([
            'persil_id'    => $request->persil_id,
            'pihak_1'      => $request->pihak_1,
            'pihak_2'      => $request->pihak_2,
            'kronologi'    => $request->kronologi,
            'status'       => $request->status,
            'penyelesaian' => $request->penyelesaian,
        ]);

        if ($request->hasFile('bukti_file')) {
            foreach ($request->file('bukti_file') as $file) {
                $path = $file->store('sengketa_persil', 'public');

                Media::create([
                    'ref_table' => 'sengketa_persil',
                    'ref_id'    => $s->sengketa_id,
                    'file_url'  => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('sengketa_persil.index')
            ->with('success', 'Sengketa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $s       = SengketaPersil::findOrFail($id);
        $persils = Persil::all();

        return view('pages.sengketa_persil.edit', compact('s', 'persils'));
    }

    public function update(Request $request, $id)
{
    // 🔒 AMBIL DATA SENGKETA (ANTI NULL)
    $s = SengketaPersil::findOrFail($id);

    // ✅ VALIDASI
    $request->validate([
        'persil_id'    => 'required|exists:persil,persil_id',
        'pihak_1'      => 'required|string|max:255',
        'pihak_2'      => 'required|string|max:255',
        'kronologi'    => 'nullable|string',
        'status'       => 'nullable|string',
        'penyelesaian' => 'nullable|string',
        'files.*'      => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,doc,docx|max:5120',
    ]);

    // ✅ UPDATE DATA UTAMA
    $s->update([
        'persil_id'    => $request->persil_id,
        'pihak_1'      => $request->pihak_1,
        'pihak_2'      => $request->pihak_2,
        'kronologi'    => $request->kronologi,
        'status'       => $request->status,
        'penyelesaian' => $request->penyelesaian,
    ]);

    // ✅ SIMPAN FILE BARU (JIKA ADA)
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {

            $path = $file->store('sengketa_persil', 'public');

            Media::create([
                'ref_table' => 'sengketa_persil',
                'ref_id'    => $s->sengketa_id, // 🔥 SEKARANG PASTI ADA
                'file_url'  => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }
    }

    return redirect()
        ->route('sengketa_persil.index')
        ->with('success', 'Sengketa berhasil diperbarui');
}



    public function destroy($id)
    {
        $s = SengketaPersil::findOrFail($id);

        foreach ($s->media as $m) {
            Storage::disk('public')->delete($m->file_url);
            $m->delete();
        }

        $s->delete();

        return redirect()->route('sengketa_persil.index')
            ->with('success', 'Sengketa berhasil dihapus');
    }
    public function destroyMedia(SengketaPersil $sengketa, Media $media)
{
    // pastikan media milik sengketa ini
    if (
        $media->ref_table !== 'sengketa_persil' ||
        $media->ref_id != $sengketa->sengketa_id
    ) {
        abort(403, 'Media tidak valid');
    }

    // hapus file fisik
    \Storage::disk('public')->delete($media->file_url);

    // hapus record DB
    $media->delete();

    return back()->with('success', 'File berhasil dihapus');
}

}
