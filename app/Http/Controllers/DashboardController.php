<?php

namespace App\Http\Controllers;
use App\Models\Persil;
use App\Models\Warga;
use App\Models\Penggunaan;
use App\Models\SengketaPersil;
use App\Models\DokumenPersil;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.guest.dashboard', [
            'totalPersil'     => Persil::count(),
            'totalWarga'      => Warga::count(),
            'totalPenggunaan' => Penggunaan::count(),
            'totalSengketa'   => SengketaPersil::count(),
            'totalDokumen'    => DokumenPersil::count(),
        ]);
           }
}
