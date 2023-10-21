<?php

use App\Http\Controllers\Admin\DepartemenController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\TiketContoller;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Karyawan\HomeController as KaryawanHomeController;
use App\Http\Controllers\Karyawan\TiketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pimpinan\HomeController as PimpinanHomeController;
use App\Http\Controllers\Pimpinan\LaporanController as PimpinanLaporanController;
use App\Http\Controllers\Teknisi\HomeController as TeknisiHomeController;
use App\Http\Controllers\Teknisi\TiketController as TeknisiTiketController;
use App\Http\Middleware\CekTipe;
use Illuminate\Support\Facades\Route;

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

Route::controller(LoginController::class)->group(function() {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::post('/login/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(HomeController::class)->group(function() {
    Route::get('/admin/home', 'index')->middleware(['auth', 'CekTipe:admin']);
});

Route::controller(KaryawanHomeController::class)->group(function() {
    Route::get('/karyawan/home', 'index')->middleware(['auth', 'CekTipe:karyawan']);
});

Route::controller(TeknisiHomeController::class)->group(function() {
    Route::get('/teknisi/home', 'index')->middleware(['auth', 'CekTipe:teknisi']);
});

Route::controller(PimpinanHomeController::class)->group(function() {
    Route::get('/pimpinan/home', 'index')->middleware(['auth', 'CekTipe:pimpinan']);
});

Route::controller(TiketContoller::class)->group(function() {
    Route::get('/admin/tiket', 'index')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/tiket/detail/{tiket:idTiket}', 'detail')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/tiket/detailKonfirmasi/{tiket:idTiket}', 'detailKonfirmasi')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/tiket/detailKonfirmasiKomplain/{tiket:idTiket}', 'detailKonfirmasiKomplain')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/tiket/konfirmasi/{tiket:idTiket}', 'konfirmasi')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/tiket/konfirmasiKomplain/{tiket:idTiket}', 'konfirmasiKomplain')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/tiket/detailPenugasan/{tiket:idTiket}', 'detailPenugasan')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/tiket/detailPenugasanKomplain/{tiket:idTiket}', 'detailPenugasanKomplain')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/tiket/penugasan/{tiket:idTiket}', 'penugasan')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/tiket/penugasanKomplain/{tiket:idTiket}', 'penugasanKomplain')->middleware(['auth', 'CekTipe:admin']);
});

Route::controller(TiketController::class)->group(function() {
    Route::get('/karyawan/tiket', 'index')->middleware(['auth', 'CekTipe:karyawan']);
    Route::get('/karyawan/tiket/create', 'create')->middleware(['auth', 'CekTipe:karyawan']);
    Route::post('/karyawan/tiket/store', 'store')->middleware(['auth', 'CekTipe:karyawan']);
    Route::get('/karyawan/tiket/detail/{tiket:idTiket}', 'detail')->middleware(['auth', 'CekTipe:karyawan']);
    Route::get('/karyawan/tiket/detailValidasi/{tiket:idTiket}', 'detailValidasi')->middleware(['auth', 'CekTipe:karyawan']);
    Route::post('/karyawan/tiket/validasi/{tiket:idTiket}', 'validasi')->middleware(['auth', 'CekTipe:karyawan']);
});

Route::controller(TeknisiTiketController::class)->group(function() {
    Route::get('/teknisi/tiket', 'index')->middleware(['auth', 'CekTipe:teknisi']);
    Route::get('/teknisi/tiket/detail/{tiket:idTiket}', 'detail')->middleware(['auth', 'CekTipe:teknisi']);
    Route::get('/teknisi/tiket/detailPenugasan/{tiket:idTiket}', 'detailPenugasan')->middleware(['auth', 'CekTipe:teknisi']);
    Route::post('/teknisi/tiket/penugasan/{tiket:idTiket}', 'penugasan')->middleware(['auth', 'CekTipe:teknisi']);
    Route::get('/teknisi/tiket/suratPenugasan/{tiket:idTiket}', 'suratPenugasan')->middleware(['auth', 'CekTipe:teknisi']);
    Route::get('/teknisi/tiket/detailValidasi/{tiket:idTiket}', 'detailValidasi')->middleware(['auth', 'CekTipe:teknisi']);
    Route::post('/teknisi/tiket/validasi/{tiket:idTiket}', 'validasi')->middleware(['auth', 'CekTipe:teknisi']);
});

Route::controller(LaporanController::class)->group(function() {
    Route::get('/admin/laporan', 'index')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/laporan/all', 'all')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/laporan/target', 'target')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/laporan/one/{tiket:idTiket}', 'one')->middleware(['auth', 'CekTipe:admin']);
});

Route::controller(PimpinanLaporanController::class)->group(function() {
    Route::get('/pimpinan/laporan', 'index')->middleware(['auth', 'CekTipe:pimpinan']);
    Route::get('/pimpinan/laporan/all', 'all')->middleware(['auth', 'CekTipe:pimpinan']);
    Route::get('/pimpinan/laporan/target', 'target')->middleware(['auth', 'CekTipe:pimpinan']);
    Route::get('/pimpinan/laporan/one/{tiket:idTiket}', 'one')->middleware(['auth', 'CekTipe:pimpinan']);
});

Route::controller(UserController::class)->group(function() {
    Route::get('/admin/user', 'index')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/user/create', 'create')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/user/store', 'store')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/user/edit/{user:nik}', 'edit')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/user/update/{user:nik}', 'update')->middleware(['auth', 'CekTipe:admin']);
    Route::post('admin/user/updatePassword/{user:nik}', 'updatePassword')->middleware(['auth', 'CekTipe:admin']);
    Route::delete('/admin/user/destroy/{user:nik}', 'destroy')->middleware(['auth', 'CekTipe:admin']);
});

Route::controller(DepartemenController::class)->group(function() {
    Route::get('/admin/departemen', 'index')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/departemen/create', 'create')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/departemen/store', 'store')->middleware(['auth', 'CekTipe:admin']);
    Route::get('/admin/departemen/edit/{departemen:kodeDepartemen}', 'edit')->middleware(['auth', 'CekTipe:admin']);
    Route::post('/admin/departemen/update/{departemen:kodeDepartemen}', 'update')->middleware(['auth', 'CekTipe:admin']);
    Route::delete('/admin/departemen/destroy/{departemen:kodeDepartemen}', 'destroy')->middleware(['auth', 'CekTipe:admin']);
});