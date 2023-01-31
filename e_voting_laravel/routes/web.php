<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\manajemenUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registrasiCalon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route untuk halaman utama
Route::get('/', [indexController::class, 'index']);
Route::get('/bukti_pemilihan/{id?}', [indexController::class, 'bukti_pemilihan']);
Route::get('/bukti_pemilihan/{id?}/print', [indexController::class, 'bukti_pemilihan_print']);

// Route autentikasi
Route::get('login', [loginController::class, 'login_page'])->name('login');
Route::get('lupa_password', [loginController::class, 'lupa_password'])->name('lupa_password');
Route::post('lupa_password', [loginController::class, 'lupa_password_save'])->name('lupa_password_save');
Route::post('login', [loginController::class, 'login'])->name('login_process');
Route::get('logout', [loginController::class, 'logout'])->name('logout');

// Route registrasi calon
Route::prefix('calon') -> controller(registrasiCalon::class) -> group(function() {
    Route::get('pendaftaran', 'registrasi');
    Route::post('pendaftaran', 'registrasi_save');
});

// Route Hanya bisa diakses ketika sudah login
Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/home', [loginController::class, 'home'])->name('alluser.home');
    Route::get('/hasil-voting', [indexController::class, 'hasil_voting']);
    Route::get('/hasil-voting/hapus', [indexController::class, 'hapus_voting']);
    Route::get('/hasil-voting/cetak/', [indexController::class, 'cetak_voting']);

    // Route admin
    Route::group(['middleware' => 'roleCheck:admin'], function () {
        Route::resource('users', manajemenUser::class) -> except(['show', 'create']);
        Route::get('calon/pasangan', [registrasiCalon::class, 'pasangan']);
        Route::post('calon/pasangan-store', [registrasiCalon::class, 'pasangan_store']);
        Route::get('calon/pasangan-hapus/{id}', [registrasiCalon::class, 'pasangan_hapus']);

        Route::get('calon/bupati', [registrasiCalon::class, 'bupati']);
        Route::get('calon/wakil_bupati', [registrasiCalon::class, 'calon_wakil']);

        Route::get('calon/bupati/hapus/{id}', [registrasiCalon::class, 'bupati_hapus']);
        Route::get('calon/bupati/toggle-pemilihan/{id}', [registrasiCalon::class, 'toggle_pemilihan']);
    });

    // Route user
    Route::group(['middleware' => 'roleCheck:user'], function () {
        Route::get('/vote/{idPasangan}', [indexController::class, 'vote']);
    });

    // Route calon bupati dan wakil
    Route::group(['middleware' => 'roleCheck:bupati,wakil_bupati'], function () {
        Route::prefix('calon') -> controller(registrasiCalon::class) -> group(function() {
            Route::get('profil', 'profil');
            Route::post('profil', 'profil_update');
        });
        
    });
});


