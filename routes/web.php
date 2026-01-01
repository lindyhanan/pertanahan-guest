<?php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenPersilController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\PertanahanController;
use App\Http\Controllers\PetaPersilController;
use App\Http\Controllers\SengketaPersilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;


Route::resource('warga', WargaController::class);
Route::resource('penggunaan', PenggunaanController::class);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login'); // jika ada form login
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// halaman dashboard (setelah login)


// Route::get('/', function () {
//     return view('pages.guest.dashboard');
// }); // ->name('dashboard')

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard.index')
    ->middleware('checkislogin');

Route::post('/penggunaan/edit', function () {
    dd(request()->all(), url()->previous());
});



Route::resource('persil', PersilController::class);
Route::delete(
    '/persil/{persil}/media/{media}',
    [PersilController::class, 'destroyMedia']
)->name('persil.media.destroy');

Route::delete('/user/{user}/photo', [UserController::class, 'destroyPhoto'])
    ->name('user.photo.destroy');

Route::group(['middleware' => ['checkrole:admin']], function () {
    Route::resource('user', UserController::class)->except(['show']);
});

Route::resource('dokumen_persil', DokumenPersilController::class);
Route::resource('peta_persil', PetaPersilController::class);
Route::delete(
    '/peta_persil/{peta}/media/{media}',
    [PetaPersilController::class, 'destroyMedia']
)->name('peta_persil.media.destroy');
Route::delete(
    '/dokumen_persil/{dokumen}/media/{media}',
    [DokumenPersilController::class, 'destroyMedia']
)->name('dokumen_persil.media.destroy');
Route::delete(
    'sengketa_persil/{sengketa}/media/{media}',
    [SengketaPersilController::class, 'destroyMedia']
)->name('sengketa_persil.media.destroy');


Route::resource('sengketa_persil', SengketaPersilController::class);
