<?php
namespace App\Http\Controllers;

use App\Models\Penggunaan;
use Illuminate\Http\Request;

class PenggunaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query  = Penggunaan::query();

        if ($search) {
            $query->where('nama_penggunaan', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%");
        }

        $data_penggunaan = $query->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('pages.penggunaan.index', compact('data_penggunaan', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.penggunaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penggunaan' => 'required|string|max:50|unique:penggunaan,nama_penggunaan',
            'keterangan'      => 'required|string|max:200',
        ]);
        $lastId = Penggunaan::max('jenis_id');
        $nextId = $lastId ? $lastId + 1 : 1;

        Penggunaan::create([
            'nama_penggunaan' => $request->nama_penggunaan,
            'keterangan'      => $request->keterangan,
        ]);

        return redirect()
            ->route('penggunaan.index')
            ->with('success', 'Data penggunaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $penggunaan = Penggunaan::findOrFail($id);
        return view('pages.penggunaan.edit', compact('penggunaan'));
    }

    public function update(Request $request, string $id)
    {
        $penggunaan = Penggunaan::findOrFail($id);

        $request->validate([
            'nama_penggunaan' => 'required|string|max:50',
            'keterangan'      => 'required|string|max:200',
        ]);

        $penggunaan->update($request->only('nama_penggunaan', 'keterangan'));

        return redirect()
            ->route('penggunaan.index')
            ->with('success', 'Data berhasil diperbarui.');
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
