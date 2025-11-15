<?php

namespace App\Http\Controllers;

use App\Models\Persil;
use Illuminate\Http\Request;

class PersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persil = Persil::all();
        return view('pages/persil.index', compact('persil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages/persil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_persil' => 'required|unique:persil',
            'pemilik_warga_id' => 'required',
            'luas_m2' => 'required',
            'alamat_lahan' => 'required',
        ]);

        Persil::create($request->all());

        return redirect()->route('persil.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $persil = Persil::findOrFail($id);
        return view('pages/persil.edit', compact('persil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $persil = Persil::findOrFail($id);
        $persil->update($request->all());

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
}
