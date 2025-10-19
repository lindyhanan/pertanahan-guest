<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PertanahanController;
use App\Http\Controllers\WargaController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisController;


Route::resource('jenis', JenisController::class);
Route::get('jenis/create', [JenisController::class, 'create'])->name('jenis.create');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga/store', [WargaController::class, 'store'])->name('warga.store');

Route::get('jenis/create', [JenisController::class, 'create'])->name('jenis.create');
Route::post('jenis/store', [JenisController::class, 'store'])->name('jenis.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pertanahan', [PertanahanController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);