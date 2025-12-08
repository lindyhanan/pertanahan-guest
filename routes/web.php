<?php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\PertanahanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::resource('jenis', JenisController::class);
Route::resource('warga', WargaController::class);
Route::resource('penggunaan', PenggunaanController::class);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login'); // jika ada form login
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// halaman dashboard (setelah login)
Route::get('/penggunaan/edit', [PenggunaanController::class, 'edit'])->name('penggunaan.edit');
Route::post('/penggunaan/edit', [PenggunaanController::class, 'update'])->name('penggunaan.update');

// Route::get('/', function () {
//     return view('pages.guest.dashboard');
// }); // ->name('dashboard')

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard.index')
    ->middleware('checkislogin');

Route::get('/pertanahan', [PertanahanController::class, 'index']);

Route::resource('persil', PersilController::class);
Route::post('persil/{persil}/media/{media}/delete', [PersilController::class, 'destroyMedia'])
    ->name('persil.media.destroy');

Route::group(['middleware' => ['checkrole:admin']], function () {
    Route::resource('user', UserController::class);
});
