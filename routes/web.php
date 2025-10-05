<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PertanahanController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pertanahan', [PertanahanController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);