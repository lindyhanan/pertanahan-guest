<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // menampilkan halaman login
    public function index()
    {
        // kalau sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        }

        return view('pages.auth.login');
    }

    // proses login

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return back()->with('error', 'Email atau password salah.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function showLoginForm()
    {
        return view('pages.auth.login'); // ganti dengan view loginmu
    }

}
