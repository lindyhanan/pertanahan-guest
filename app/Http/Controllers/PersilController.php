<?php
namespace App\Http\Controllers;

use App\Models\Persil;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return view('pages.persil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_persil'      => 'required|unique:persil',
            'pemilik_warga_id' => 'required',
            'luas_m2'          => 'required|numeric',
            'alamat_lahan'     => 'required',
            'media.*'          => 'nullable|file|max:5120',
        ]);

        // Simpan persil
        $persil = Persil::create($request->only([
            'kode_persil',
            'pemilik_warga_id',
            'luas_m2',
            'penggunaan',
            'alamat_lahan',
            'rt',
            'rw'
        ]));

        // Handle multiple media (opsional)
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                if (!$file->isValid()) continue;

                // Save file to storage/app/public/media
                $path = $file->store('media', 'public'); // returns path like media/xxxx.jpg

                Media::create([
                    'ref_table' => 'persil',
                    'ref_id'    => $persil->persil_id,
                    'file_url'  => $path,
                    'caption'   => null,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> 0,
                ]);
            }
        }

        return redirect()->route('persil.index')->with('success', 'Data berhasil ditambahkan');
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
            'kode_persil'      => 'required|unique:persil,kode_persil,' . $persil->persil_id . ',persil_id',
            'pemilik_warga_id' => 'required',
            'luas_m2'          => 'required|numeric',
            'alamat_lahan'     => 'required',
            'media.*'          => 'nullable|file|max:5120',
        ]);

        $persil->update($request->only([
            'kode_persil',
            'pemilik_warga_id',
            'luas_m2',
            'penggunaan',
            'alamat_lahan',
            'rt',
            'rw'
        ]));

        // Tambah file baru jika ada
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                if (!$file->isValid()) continue;

                $path = $file->store('media', 'public');
                Media::create([
                    'ref_table' => 'persil',
                    'ref_id'    => $persil->persil_id,
                    'file_url'  => $path,
                    'caption'   => null,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> 0,
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
    public function destroyMedia(Request $request, $persilId, $mediaId)
    {
        $media = Media::where('media_id', $mediaId)
                      ->where('ref_table', 'persil')
                      ->where('ref_id', $persilId)
                      ->firstOrFail();

        // hapus file fisik
        if ($media->file_url && Storage::disk('public')->exists($media->file_url)) {
            Storage::disk('public')->delete($media->file_url);
        }

        $media->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }
}
