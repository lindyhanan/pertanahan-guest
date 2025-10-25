<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PertanahanController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisController;


Route::resource('jenis', JenisController::class);
Route::resource('warga', WargaController::class);
Route::resource('penggunaan', PenggunaanController::class);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login'); // jika ada form login
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('/dashboard', function() {
    return view('pertanahan.dashboard');
})->middleware('auth');  // hanya bisa diakses kalau sudah login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// halaman dashboard (setelah login)
Route::get('/dashboard', function () {
    return view('pertanahan.dashboard');
})->middleware('auth')->name('dashboard');

Route::resource('user', UserController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pertanahan', [PertanahanController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);