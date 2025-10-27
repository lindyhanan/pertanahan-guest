<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\PertanahanController;


Route::resource('jenis', JenisController::class);
Route::resource('warga', WargaController::class);
Route::resource('penggunaan', PenggunaanController::class);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login'); // jika ada form login
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// halaman dashboard (setelah login)

Route::resource('user', UserController::class);

Route::get('/', function () {
    return view('guest.dashboard');
})->name('dashboard');

Route::get('/pertanahan', [PertanahanController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
