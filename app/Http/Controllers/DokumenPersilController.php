<?php
namespace App\Http\Controllers;

use App\Models\DokumenPersil;
use App\Models\media;
use App\Models\Persil;
use Illuminate\Http\Request;

class DokumenPersilController extends Controller
{
    public function index()
    {
        $dokumens = DokumenPersil::with(['persil', 'media'])->get();
        return view('pages.dokumen_persil.index', compact('dokumens'));
    }

    public function create()
    {
        $persils = Persil::all();
        return view('pages.dokumen_persil.create', compact('persils'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'persil_id'      => 'required|exists:persil,persil_id',
            'jenis_dokumen'  => 'required|string|max:255',
            'nomor'          => 'required|string|max:255',
            'keterangan'     => 'nullable|string|max:500',
            'dokumen_file.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $dok = DokumenPersil::create($validated);

        if ($request->hasFile('dokumen_file')) {
            foreach ($request->file('dokumen_file') as $file) {
                $path = $file->store('images', 'public');
                Media::create([
                    'ref_table' => 'dokumen_persil',
                    'ref_id'    => $dok->dokumen_id,
                    'file_url'  => 'storage/' . $path,
                ]);
            }
        }

        return redirect()->route('dokumen_persil.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(DokumenPersil $dokumenPersil)
    {
        $persils = Persil::all();
        return view('pages.dokumen_persil.edit', compact('dokumenPersil', 'persils'));
    }

    public function update(Request $request, DokumenPersil $dokumenPersil)
    {
        $validated = $request->validate([
            'persil_id'      => 'required|exists:persil,persil_id',
            'jenis_dokumen'  => 'required|string|max:255',
            'nomor'          => 'required|string|max:255',
            'keterangan'     => 'nullable|string|max:500',
            'dokumen_file.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        // Update data utama
        $dokumenPersil->update($validated);

        // Upload file baru
        if ($request->hasFile('dokumen_file')) {
            foreach ($request->file('dokumen_file') as $file) {
                $path = $file->store('images', 'public');
                Media::create([
                    'ref_table' => 'dokumen_persil',
                    'ref_id'    => $dokumenPersil->dokumen_id,
                    'file_url'  => 'storage/' . $path,
                ]);
            }
        }

        return redirect()->route('dokumen_persil.index')->with('success', 'Dokumen berhasil diupdate.');
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
}
