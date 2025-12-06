<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        // Variabel filter yang tidak ada di skema migrasi (jenis_kelamin dan agama)
        // akan tetap diambil dari request untuk keperluan view, namun tidak digunakan dalam query database.
        $jenis_kelamin = $request->query('jenis_kelamin');
        $agama         = $request->query('agama');

        $warga = Warga::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_ktp', 'like', "%{$search}%")  // Mengganti 'no_ktp' menjadi 'nik'
                    ->orWhere('alamat', 'like', "%{$search}%"); // Menambahkan pencarian alamat

            })
            ->orderBy('nama')
            ->paginate(9)        // tampil 9 data per halaman
            ->withQueryString(); // biar query search/filter tetap ada saat pagination

        return view('pages.warga.index', compact('warga', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'no_ktp'        => 'required|string|max:20',
            'alamat'        => 'nullable|string|max:255', // <-- Tambahan alamat
            'jenis_kelamin' => 'required|string',
            'agama'         => 'nullable|string',
            'pekerjaan'     => 'nullable|string',
            'telp'          => 'nullable|string',
            'email'         => 'nullable|email',
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
