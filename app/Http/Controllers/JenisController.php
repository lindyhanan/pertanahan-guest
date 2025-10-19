<?php

namespace App\Http\Controllers;

use App\Models\Jenis; 
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataPertanahan = Pertanahan::all();

        // Kirim ke view
        return view('create', compact('dataPertanahan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis_penggunaan = Jenis::all();
        return view('pertanahan.create', compact('jenis_penggunaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $data['nama_penggunaan'] = $request->nama_penggunaan;
		$data['keterangan'] = $request->keterangan;
		
		Jenis::create($data);
		
		return redirect()->route('jenis.create')->with('success','Penambahan Data Berhasil!');
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
