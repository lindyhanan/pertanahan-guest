<?php
namespace App\Http\Controllers;

use App\Models\media;
use App\Models\Persil;
use App\Models\SengketaPersil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SengketaPersilController extends Controller
{
    public function index()
    {
        $sengketa = SengketaPersil::with(['persil', 'media'])->get();
        return view('pages.sengketa_persil.index', compact('sengketa'));
    }

    public function create()
    {
        $persils = Persil::all();
        return view('pages.sengketa_persil.create', compact('persils'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'persil_id'    => 'required|exists:persil,persil_id',
            'pihak_1'      => 'required|string|max:255',
            'pihak_2'      => 'required|string|max:255',
            'kronologi'    => 'nullable|string',
            'status'       => 'required|string|in:proses,selesai', // sesuaikan enum di DB
            'penyelesaian' => 'nullable|string|max:255',
            'bukti_file.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Simpan Sengketa
        $s = SengketaPersil::create($request->only([
            'persil_id', 'pihak_1', 'pihak_2', 'kronologi', 'status', 'penyelesaian',
        ]));

        // Simpan file jika ada
        if ($request->hasFile('bukti_file')) {
            foreach ($request->file('bukti_file') as $file) {
                $path = $file->store('sengketa_persil', 'public'); // optional 'public' agar bisa diakses
                Media::create([
                    'ref_table' => 'sengketa_persil',
                    'ref_id'    => $s->sengketa_id,
                    'file_url'  => $path, // <-- ini penting
                ]);
            }
        }

        return redirect()->route('sengketa_persil.index')
            ->with('success', 'Sengketa berhasil ditambahkan');
    }
    public function edit($id)
    {
        $s = SengketaPersil::findOrFail($id);
        return view('pages.sengketa_persil.edit', compact('s'));
    }

    public function update(Request $request, $id)
    {
        $s = SengketaPersil::findOrFail($id);

        // Validasi input
        $request->validate([
            'persil_id'    => 'required|exists:persil,persil_id',
            'pihak_1'      => 'required|string|max:255',
            'pihak_2'      => 'required|string|max:255',
            'kronologi'    => 'nullable|string',
            'status'       => 'required|string|in:proses,selesai', // sesuaikan enum di DB
            'penyelesaian' => 'nullable|string|max:255',
            'bukti_file.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        // Update Sengketa
        $s->update($request->only([
            'persil_id', 'pihak_1', 'pihak_2', 'kronologi', 'status', 'penyelesaian',
        ]));

        // Update file jika ada
        if ($request->hasFile('bukti_file')) {
            foreach ($request->file('bukti_file') as $file) {
                $path = $file->store('sengketa_persil', 'public');
                $s->media()->create([
                    'ref_table' => 'sengketa_persil',
                    'ref_id'    => $s->sengketa_id,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('sengketa_persil.index')
            ->with('success', 'Sengketa berhasil diupdate');
    }

    public function destroy($id)
    {
        $s = SengketaPersil::findOrFail($id);

        // Hapus file media fisik
        foreach ($s->media as $m) {
            Storage::delete($m->file_path);
            $m->delete();
        }

        $s->delete();

        return redirect()->route('sengketa_persil.index')->with('success', 'Sengketa berhasil dihapus');
    }
}
