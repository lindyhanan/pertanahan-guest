<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = Warga::all();
        return view('pages.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warga = Warga::latest()->get();
        return view('pages.warga.index', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|string',
            'agama' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'telp' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        Warga::create($validated);

        return redirect()->back()->with('success', 'Data warga berhasil ditambahkan!');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
