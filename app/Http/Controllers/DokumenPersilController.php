<?php
namespace App\Http\Controllers;

use App\Models\DokumenPersil;
use App\Models\Media;
use App\Models\Persil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumenPersilController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        $jenis  = $request->jenis;

        $dokumens = DokumenPersil::with(['persil', 'media'])
            ->when($search, function ($query) use ($search) {
                $query->where('nomor', 'like', "%{$search}%")
                    ->orWhere('jenis_dokumen', 'like', "%{$search}%")
                    ->orWhereHas('persil', function ($q) use ($search) {
                        $q->where('kode_persil', 'like', "%{$search}%");
                    });
            })
            ->when($jenis, function ($query) use ($jenis) {
                $query->where('jenis_dokumen', $jenis);
            })
            ->latest()
            ->paginate(9)        // ⬅️ WAJIB paginate
            ->withQueryString(); // ⬅️ BIAR FILTER TIDAK HILANG

        return view('pages.dokumen_persil.index', compact('dokumens'));
    }

    public function create()
    {
        $persils = Persil::all();
        return view('pages.dokumen_persil.create', compact('persils'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persil_id'     => 'required|exists:persil,persil_id',
            'jenis_dokumen' => 'required|string',
            'nomor'         => 'required|string',
            'keterangan'    => 'nullable|string',
            'files.*'       => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        DB::transaction(function () use ($request) {

            // 1️⃣ SIMPAN DOKUMEN (PAKSA SAVE)
            $dokumen                = new DokumenPersil();
            $dokumen->persil_id     = $request->persil_id;
            $dokumen->jenis_dokumen = $request->jenis_dokumen;
            $dokumen->nomor         = $request->nomor;
            $dokumen->keterangan    = $request->keterangan;
            $dokumen->save();

            // 2️⃣ PAKSA AMBIL ULANG ID DARI DATABASE
            $dokumen->refresh();

            // 🔥 PENGAMAN TERAKHIR
            if (! $dokumen->dokumen_id) {
                throw new \Exception('Gagal mendapatkan dokumen_id');
            }

            // 3️⃣ SIMPAN FILE
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {

                    $path = $file->store('dokumen_persil', 'public');

                    Media::create([
                        'ref_table' => 'dokumen_persil',
                        'ref_id'    => $dokumen->dokumen_id,
                        'file_url'  => $path,
                        'mime_type' => $file->getClientMimeType(),
                    ]);
                }
            }
        });

        return redirect()
            ->route('dokumen_persil.index')
            ->with('success', 'Dokumen berhasil disimpan');
    }

    public function edit(DokumenPersil $dokumenPersil)
    {
        $persils = Persil::all();
        $dokumen = $dokumenPersil;

        return view(
            'pages.dokumen_persil.edit',
            compact('dokumen', 'persils')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'persil_id'     => 'required|exists:persil,persil_id',
            'jenis_dokumen' => 'required|string',
            'nomor'         => 'required|string',
            'keterangan'    => 'nullable|string',
            'files.*'       => 'nullable|file|max:5120',
        ]);

        $dokumen = DokumenPersil::findOrFail($id);

        $dokumen->update([
            'persil_id'     => $request->persil_id,
            'jenis_dokumen' => $request->jenis_dokumen,
            'nomor'         => $request->nomor,
            'keterangan'    => $request->keterangan,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $path = $file->store('dokumen_persil', 'public');

                Media::create([
                    'ref_table' => 'dokumen_persil',
                    'ref_id'    => $dokumen->dokumen_id, // 🔥 SEKARANG PASTI ADA
                    'file_url'  => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()
            ->route('dokumen_persil.index')
            ->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy(DokumenPersil $dokumenPersil)
    {
        // Hapus media terkait
        foreach ($dokumenPersil->media as $media) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $media->file_url));
            $media->delete();
        }

        $dokumenPersil->delete();

        return redirect()->route('dokumen_persil.index')->with('success', 'Dokumen berhasil dihapus.');
    }
    public function destroyMedia($dokumenId, $mediaId)
    {
        $media = Media::where('media_id', $mediaId)
            ->where('ref_table', 'dokumen_persil')
            ->where('ref_id', $dokumenId)
            ->firstOrFail();

        // hapus file fisik
        Storage::disk('public')->delete($media->file_url);

        // hapus record DB
        $media->delete();

        return back()->with('success', 'File berhasil dihapus');
    }
}
