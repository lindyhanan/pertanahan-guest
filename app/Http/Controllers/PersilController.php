<?php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Penggunaan;
use App\Models\Persil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search  = $request->query('search');
        $pemilik = $request->query('pemilik');
        $alamat  = $request->query('alamat');

        $persil = Persil::query()
            ->when($search, function ($query, $search) {
                $query->where('kode_persil', 'like', "%{$search}%")
                    ->orWhere('alamat_lahan', 'like', "%{$search}%");
            })
            ->when($pemilik, function ($query, $pemilik) {
                $query->where('pemilik_warga_id', $pemilik);
            })
            ->when($alamat, function ($query, $alamat) {
                $query->where('alamat_lahan', 'like', "%{$alamat}%");
            })
            ->orderBy('kode_persil')
            ->paginate(9)
            ->withQueryString();

        return view('pages.persil.index', compact('persil', 'search', 'pemilik', 'alamat'));
    }

    public function create()
{
    $penggunaanList = Penggunaan::orderBy('nama_penggunaan')->get();

    // (opsional) kode persil untuk tampilan
    $maxNo = Persil::selectRaw("MAX(CAST(SUBSTRING(kode_persil, 2) AS UNSIGNED)) as max_no")
        ->value('max_no');
    $nextNumber = ($maxNo ?? 0) + 1;
    $kodePersil = 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    return view('pages.persil.create', compact('kodePersil', 'penggunaanList'));
}


    public function store(Request $request)
{
    $request->validate([
        'pemilik_warga_id' => 'required|exists:warga,warga_id',
        'luas_m2'          => 'required|numeric',
        'penggunaan_id'    => 'required|exists:penggunaan,jenis_id',
        'alamat_lahan'     => 'required',
        'rt'               => 'nullable',
        'rw'               => 'nullable',
    ]);

    // DEBUG 1x: pastikan terkirim
    // dd($request->all());

    // sementara: pake kode dari form dulu biar simpel
    $kodePersil = $request->kode_persil;

    $persil = Persil::create([
        'kode_persil'      => $kodePersil,
        'pemilik_warga_id' => $request->pemilik_warga_id,
        'luas_m2'          => $request->luas_m2,
        'penggunaan_id'    => $request->penggunaan_id, // ✅ INI KUNCI
        'alamat_lahan'     => $request->alamat_lahan,
        'rt'               => $request->rt,
        'rw'               => $request->rw,
    ]);

    return redirect()->route('persil.index')->with('success', "Persil {$persil->kode_persil} berhasil ditambahkan");
}



    public function edit(string $id)
    {
        $persil         = Persil::findOrFail($id);
        $penggunaanList = Penggunaan::orderBy('nama_penggunaan')->get();

        return view('pages.persil.edit', compact('persil', 'penggunaanList'));
    }

    public function update(Request $request, string $id)
    {
        $persil = Persil::findOrFail($id);

        $request->validate([
            'kode_persil'      => 'required|unique:persil,kode_persil,' . $persil->persil_id . ',persil_id',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2'          => 'required|numeric',
            'penggunaan_id'    => 'required|exists:penggunaan,jenis_id',
            'alamat_lahan'     => 'required',
            'rt'               => 'nullable',
            'rw'               => 'nullable',
            'media.*'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $persil->update([
            'kode_persil'      => $request->kode_persil,
            'pemilik_warga_id' => $request->pemilik_warga_id,
            'luas_m2'          => $request->luas_m2,
            'penggunaan_id'    => $request->penggunaan_id,
            'alamat_lahan'     => $request->alamat_lahan,
            'rt'               => $request->rt,
            'rw'               => $request->rw,
        ]);

        // upload media baru
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                if (! $file || ! $file->isValid()) {
                    continue;
                }

                $path = $file->store('media', 'public');

                Media::create([
                    'ref_table' => 'persil',
                    'ref_id'    => $persil->persil_id,
                    'file_url'  => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        Persil::destroy($id);
        return redirect()->route('persil.index')->with('success', 'Data dihapus');
    }

    public function destroyMedia($persilId, $mediaId)
    {
        $media = Media::where('media_id', $mediaId)
            ->where('ref_table', 'persil')
            ->where('ref_id', $persilId)
            ->firstOrFail();

        if ($media->file_url && Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        $media->delete();

        return redirect()
            ->back()
            ->withFragment('detail-' . $persilId)
            ->with('success', 'File berhasil dihapus');
    }
}
