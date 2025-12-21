<?php
namespace App\Http\Controllers;

use App\Models\media;
use App\Models\Persil;
use Illuminate\Http\Request;
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
            ->paginate(9)        // tampil 9 persil per halaman
            ->withQueryString(); // menjaga query tetap ada saat pagination

        return view('pages.persil.index', compact('persil', 'search', 'pemilik', 'alamat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $lastPersil = Persil::orderBy('persil_id', 'desc')->first();

    if ($lastPersil) {
        $lastNumber = (int) substr($lastPersil->kode_persil, 1);
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1;
    }

    $kodePersil = 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    return view('pages.persil.create', compact('kodePersil'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'pemilik_warga_id' => 'required|exists:warga,warga_id',
        'luas_m2'          => 'required|numeric',
        'alamat_lahan'     => 'required',
        'media.*'          => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
    ]);

    // ===============================
    // AUTO GENERATE KODE PERSIL
    // ===============================
    $lastPersil = Persil::orderBy('persil_id', 'desc')->first();

    if ($lastPersil && preg_match('/P(\d+)/', $lastPersil->kode_persil, $match)) {
        $nextNumber = (int) $match[1] + 1;
    } else {
        $nextNumber = 1;
    }

    $kodePersil = 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    // ===============================
    // SIMPAN PERSIL
    // ===============================
    $persil = Persil::create([
        'kode_persil'      => $kodePersil,
        'pemilik_warga_id' => $request->pemilik_warga_id,
        'luas_m2'          => $request->luas_m2,
        'penggunaan_id'    => $request->penggunaan_id,
        'alamat_lahan'     => $request->alamat_lahan,
        'rt'               => $request->rt,
        'rw'               => $request->rw,
    ]);

    // ===============================
    // SIMPAN MEDIA
    // ===============================
    if ($request->hasFile('media')) {
        foreach ($request->file('media') as $file) {
            if (! $file || ! $file->isValid()) continue;

            $path = $file->store('media', 'public');

            Media::create([
                'ref_table' => 'persil',
                'ref_id'    => $persil->persil_id,
                'file_url'  => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }
    }

    return redirect()
        ->route('persil.index')
        ->with('success', "Persil {$kodePersil} berhasil ditambahkan");
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $persil = Persil::with('media')->findOrFail($id);
        return view('pages.persil.show', compact('persil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $persil = Persil::findOrFail($id);
        return view('pages.persil.edit', compact('persil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $persil = Persil::findOrFail($id);

        $request->validate([
            'pemilik_warga_id' => 'required',
            'luas_m2'          => 'required|numeric',
            'alamat_lahan'     => 'required',
            'media.*'          => 'nullable|file|max:5120',
        ]);

        $persil->update([
    'pemilik_warga_id' => $request->pemilik_warga_id,
    'luas_m2'          => $request->luas_m2,
    'penggunaan_id'    => $request->penggunaan_id,
    'alamat_lahan'     => $request->alamat_lahan,
    'rt'               => $request->rt,
    'rw'               => $request->rw,
]);


        // Tambah file baru jika ada
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                if (! $file->isValid()) {
                    continue;
                }

                $path = $file->store('media', 'public');
                Media::create([
                    'ref_table'  => 'persil',
                    'ref_id'     => $persil->persil_id,
                    'file_url'   => $path,
                    'caption'    => null,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => 0,
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Persil::destroy($id);
        return redirect()->route('persil.index')->with('success', 'Data dihapus');
    }

    /**
     * Delete a single media item for a persil.
     * Route: POST /persil/{persil}/media/{media}/delete
     */
    public function destroyMedia($persilId, $mediaId)
    {
        $media = Media::where('media_id', $mediaId)
            ->where('ref_table', 'persil')
            ->where('ref_id', $persilId)
            ->firstOrFail();

        // HAPUS FILE FISIK
        if ($media->file_url && Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        // HAPUS DB
        $media->delete();

        return redirect()
            ->back()
            ->withFragment('detail-' . $persilId)
            ->with('success', 'File berhasil dihapus');

    }
}
