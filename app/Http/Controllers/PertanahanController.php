<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PertanahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $persil = [
            [
                'persil_id' => 1,
                'kode_persil' => 'PRS-001',
                'alamat_lahan' => 'Jl. Melati No. 5',
                'luas_m2' => 250,
                'penggunaan' => 'Rumah Tinggal',
                'rt' => '01',
                'rw' => '02',
            ],
            [
                'persil_id' => 2,
                'kode_persil' => 'PRS-002',
                'alamat_lahan' => 'Jl. Mawar No. 10',
                'luas_m2' => 180,
                'penggunaan' => 'Toko',
                'rt' => '01',
                'rw' => '03',
            ],
        ];

        $sengketa = [
            [
                'sengketa_id' => 1,
                'persil_id' => 1,
                'pihak_1' => 'Budi',
                'pihak_2' => 'Andi',
                'kronologi' => 'Sengketa batas tanah',
                'status' => 'Proses',
                'penyelesaian' => '-',
            ],
            [
                'sengketa_id' => 2,
                'persil_id' => 2,
                'pihak_1' => 'Siti',
                'pihak_2' => 'Rudi',
                'kronologi' => 'Tumpang tindih kepemilikan',
                'status' => 'Selesai',
                'penyelesaian' => 'Mediasi Desa',
            ],
        ];

        // kirim ke view
        return view('pertanahan.index', compact('persil', 'sengketa'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
