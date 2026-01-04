<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->query('search');
    $jenis_kelamin = $request->query('jenis_kelamin');

    $warga = Warga::query()
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_ktp', 'like', "%{$search}%");
            });
        })
        ->when($jenis_kelamin, function ($query, $jenis_kelamin) {
            $query->where('jenis_kelamin', $jenis_kelamin);
        })
        ->orderBy('nama')
        ->paginate(9)
        ->withQueryString();

    return view(
        'pages.warga.index',
        compact('warga', 'search', 'jenis_kelamin')
    );
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $lastId = Warga::max('warga_id');
    $nextId = $lastId ? $lastId + 1 : 1;

    return view('pages.warga.create', compact('nextId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'no_ktp'        => 'required|string|max:20',
            'jenis_kelamin' => 'required|string',
            'agama'         => 'nullable|string',
            'pekerjaan'     => 'nullable|string',
            'telp'          => 'nullable|string',
            'email'         => 'nullable|email',
            'foto'          => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('warga', 'public');
        }

        Warga::create($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $data = $request->validate([
            'nama'          => 'required|string|max:255',
            'pekerjaan'     => 'nullable|string|max:255',
            'no_ktp'        => 'nullable|string|max:50',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email',
            'jenis_kelamin' => 'nullable|string',
            'foto'          => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('foto')) {

            if ($warga->foto && Storage::disk('public')->exists($warga->foto)) {
                Storage::disk('public')->delete($warga->foto);
            }

            $data['foto'] = $request->file('foto')->store('warga', 'public');
        }

        $warga->update($data);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);

        if ($warga->foto && Storage::disk('public')->exists($warga->foto)) {
            Storage::disk('public')->delete($warga->foto);
        }

        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus');
    }
}
