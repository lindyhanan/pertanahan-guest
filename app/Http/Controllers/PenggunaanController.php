<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penggunaan;

class PenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penggunaan::query();

        if ($request->has('search')) {
            $query->where('nama_penggunaan', 'like', '%' . $request->search . '%');
        }

        $data_penggunaan = $query->orderBy('created_at', 'desc')->get();

        return view('penggunaan.index', compact('data_penggunaan'));
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
        $request->validate([
            'nama_penggunaan' => 'required|string|max:50|unique:penggunaan,nama_penggunaan',
            'keterangan' => 'required|string|max:200',
        ]);

        Penggunaan::create($request->all());

        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil ditambahkan!');
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
        Penggunaan::findOrFail($id)->delete();
        return redirect()->route('penggunaan.index')->with('success', 'Data berhasil dihapus.');
    }
}
