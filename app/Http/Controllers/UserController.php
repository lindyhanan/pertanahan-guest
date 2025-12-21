<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Tampilkan semua data user.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString(); // biar query search tetap ada saat pagination

        return view('pages.user.index', compact('users', 'search'));
    }

    /**
     * Tampilkan form tambah user baru.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,staff,klien',
            'password' => 'required|min:6|confirmed', // pastikan ada password_confirmation di form
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,staff,klien',
            'foto'     => 'nullable|image|max:5120',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        /* ===============================
       HANDLE FOTO PROFILE
       =============================== */
        if ($request->hasFile('foto')) {

            // hapus foto lama (jika ada)
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // simpan foto baru
            $data['foto'] = $request->file('foto')->store('users', 'public');
        }

        /* ===============================
       HANDLE PASSWORD
       =============================== */
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }
//    public function show($id)
//     {
//         $user = User::with('media')->findOrFail($id);
//         return view('pages.user.show', compact('user'));
//     }
    /**
     * Hapus data user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }

    public function destroyPhoto($id)
    {
        $user = User::findOrFail($id);

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->update([
            'foto' => null,
        ]);

        return redirect()
            ->route('user.edit', $user->id)
            ->with('success', 'Foto profile berhasil dihapus.');

    }

}
