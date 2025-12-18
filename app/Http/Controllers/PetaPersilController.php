<?php
namespace App\Http\Controllers;

use App\Models\media;
use App\Models\PetaPersil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaPersilController extends Controller
{
    public function index()
    {
        $peta = PetaPersil::with(['media', 'persil'])->get();
        return view('pages.peta_persil.index', compact('peta'));
    }

    public function create()
    {
        return view('pages.peta_persil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'persil_id'      => 'required|exists:persil,id',
            'geojson'        => 'required|string',
            'persil_id'      => 'required|exists:persil,persil_id',
            'panjang_m'      => 'required|numeric',
            'lebar_m'        => 'required|numeric',
            'dokumen_file.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf', // sesuaikan tipe file
        ]);

        // Simpan Peta Persil
        $peta = PetaPersil::create($request->only(['persil_id', 'geojson', 'panjang_m', 'lebar_m']));

        // Upload file jika ada
        if ($request->hasFile('dokumen_file')) {
            foreach ($request->file('dokumen_file') as $file) {
                $path = $file->store('images', 'public'); // storage/app/public/images

                $peta->media()->create([
                    'ref_table' => 'peta_persil',
                    'file_url'  => $path,
                ]);
            }
        }

        return redirect()->route('peta_persil.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $p = PetaPersil::findOrFail($id);
        return view('pages.peta_persil.edit', compact('p'));
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

        $p = PetaPersil::findOrFail($id);
        $p->update($request->only(['persil_id', 'geojson', 'panjang_m', 'lebar_m']));

        // Upload file baru jika ada
        if ($request->hasFile('dokumen_file')) {
            foreach ($request->file('dokumen_file') as $file) {
                $path = $file->store('images', 'public'); // path di storage/app/public/images

                $p->media()->create([
                    'ref_table' => 'peta_persil',
                    'file_url'  => $path, // pastikan nama kolom sesuai database
                ]);
            }
        }

        return redirect()->route('peta_persil.index')->with('success', 'Peta berhasil diupdate');
    }

    public function destroy($id)
    {
        $p = PetaPersil::findOrFail($id);

        // Hapus file media fisik
        foreach ($p->media as $m) {
            Storage::delete($m->file_path);
            $m->delete();
        }

        $p->delete();

        return redirect()->route('peta_persil.index')->with('success', 'Peta berhasil dihapus');
    }
}
