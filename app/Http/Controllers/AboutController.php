<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        // Jika pakai database
        // $about = About::first();

        // Jika statis
        $about = (object)[
            'title' => 'Tentang Aplikasi',
            'content' => 'Ini adalah aplikasi manajemen data pertanahan dan warga yang dibuat untuk memudahkan administrasi secara digital. Aplikasi ini menggunakan Laravel + Bootstrap dan desain konsisten dengan dashboard lain.'
        ];

        return view('pages.about.index', compact('about'));
    }
}
