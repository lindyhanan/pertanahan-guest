<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Persil;
use App\Models\Penggunaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersilController extends Controller
{
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
        // untuk tampilan saja (perkiraan). Kode final dibuat di store()
        $maxNo = Persil::selectRaw("MAX(CAST(SUBSTRING(kode_persil, 2) AS UNSIGNED)) as max_no")
            ->value('max_no');

        $nextNumber = ($maxNo ?? 0) + 1;
        $kodePersil = 'P' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $penggunaanList = Penggunaan::orderBy('nama_penggunaan')->get();

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
            'media.*'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $persil = DB::transaction(function () use ($request) {
            // ambil nomor terbesar dari kode_persil
            $maxNo = Persil::selectRaw("MAX(CAST(SUBSTRING(kode_persil, 2) AS UNSIGNED)) as max_no")
                ->value('max_no');

            $nextNumber = ($maxNo ?? 0) + 1;

            // retry kalau kebetulan tabrakan (misal submit barengan)
            for ($i = 0; $i < 20; $i++) {
                $kodePersil = 'P' . str_pad($nextNumber + $i, 3, '0', STR_PAD_LEFT);

                try {
                    return Persil::create([
                        'kode_persil'      => $kodePersil,
                        'pemilik_warga_id' => $request->pemilik_warga_id,
                        'luas_m2'          => $request->luas_m2,
                        'penggunaan_id'    => $request->penggunaan_id,
                        'alamat_lahan'     => $request->alamat_lahan,
                        'rt'               => $request->rt,
                        'rw'               => $request->rw,
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    // MySQL duplicate key = 1062
                    if (($e->errorInfo[1] ?? null) == 1062) {
                        continue;
                    }
                    throw $e;
                }
            }

            throw new \RuntimeException('Gagal membuat kode persil unik.');
        });

        // upload media
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
            ->with('success', "Persil {$persil->kode_persil} berhasil ditambahkan");
    }

    public function edit(string $id)
    {
        $persil = Persil::findOrFail($id);
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

        return redirect()->route('persil.index')->with('success', 'Data berhasil diperbarui');
    }

    // destroyMedia punyamu biarkan, sudah oke
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
