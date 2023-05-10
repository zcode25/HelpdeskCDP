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
    Route::post('/login/authenticate', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::controller(HomeController::class)->group(function() {
    Route::get('/admin/home', 'index')->middleware('auth');
});

Route::controller(KaryawanHomeController::class)->group(function() {
    Route::get('/karyawan/home', 'index')->middleware('auth');
});

Route::controller(TeknisiHomeController::class)->group(function() {
    Route::get('/teknisi/home', 'index')->middleware('auth');
});

Route::controller(PimpinanHomeController::class)->group(function() {
    Route::get('/pimpinan/home', 'index')->middleware('auth');
});

Route::controller(TiketContoller::class)->group(function() {
    Route::get('/admin/tiket', 'index');
    Route::get('/admin/tiket/detail/{tiket:idTiket}', 'detail');
    Route::get('/admin/tiket/detailKonfirmasi/{tiket:idTiket}', 'detailKonfirmasi');
    Route::get('/admin/tiket/detailKonfirmasiKomplain/{tiket:idTiket}', 'detailKonfirmasiKomplain');
    Route::post('/admin/tiket/konfirmasi/{tiket:idTiket}', 'konfirmasi');
    Route::post('/admin/tiket/konfirmasiKomplain/{tiket:idTiket}', 'konfirmasiKomplain');
    Route::get('/admin/tiket/detailPenugasan/{tiket:idTiket}', 'detailPenugasan');
    Route::get('/admin/tiket/detailPenugasanKomplain/{tiket:idTiket}', 'detailPenugasanKomplain');
    Route::post('/admin/tiket/penugasan/{tiket:idTiket}', 'penugasan');
    Route::post('/admin/tiket/penugasanKomplain/{tiket:idTiket}', 'penugasanKomplain');
});

Route::controller(TiketController::class)->group(function() {
    Route::get('/karyawan/tiket', 'index');
    Route::get('/karyawan/tiket/create', 'create');
    Route::post('/karyawan/tiket/store', 'store');
    Route::get('/karyawan/tiket/detail/{tiket:idTiket}', 'detail');
    Route::get('/karyawan/tiket/detailValidasi/{tiket:idTiket}', 'detailValidasi');
    Route::post('/karyawan/tiket/validasi/{tiket:idTiket}', 'validasi');
});

Route::controller(TeknisiTiketController::class)->group(function() {
    Route::get('/teknisi/tiket', 'index');
    Route::get('/teknisi/tiket/detail/{tiket:idTiket}', 'detail');
    Route::get('/teknisi/tiket/detailPenugasan/{tiket:idTiket}', 'detailPenugasan');
    Route::post('/teknisi/tiket/penugasan/{tiket:idTiket}', 'penugasan');
    Route::get('/teknisi/tiket/suratPenugasan/{tiket:idTiket}', 'suratPenugasan');
    Route::get('/teknisi/tiket/detailValidasi/{tiket:idTiket}', 'detailValidasi');
    Route::post('/teknisi/tiket/validasi/{tiket:idTiket}', 'validasi');
});

Route::controller(LaporanController::class)->group(function() {
    Route::get('/admin/laporan', 'index');
    Route::get('/admin/laporan/all', 'all');
    Route::get('/admin/laporan/target', 'target');
    Route::get('/admin/laporan/one/{tiket:idTiket}', 'one');
});

Route::controller(PimpinanLaporanController::class)->group(function() {
    Route::get('/pimpinan/laporan', 'index');
    Route::get('/pimpinan/laporan/all', 'all');
    Route::get('/pimpinan/laporan/target', 'target');
    Route::get('/pimpinan/laporan/one/{tiket:idTiket}', 'one');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/admin/user', 'index');
    Route::get('/admin/user/create', 'create');
    Route::post('/admin/user/store', 'store');
    Route::get('/admin/user/edit/{user:nik}', 'edit');
    Route::post('/admin/user/update/{user:nik}', 'update');
    Route::delete('/admin/user/destroy/{user:nik}', 'destroy');
});

Route::controller(DepartemenController::class)->group(function() {
    Route::get('/admin/departemen', 'index');
    Route::get('/admin/departemen/create', 'create');
    Route::post('/admin/departemen/store', 'store');
    Route::get('/admin/departemen/edit/{departemen:kodeDepartemen}', 'edit');
    Route::post('/admin/departemen/update/{departemen:kodeDepartemen}', 'update');
    Route::delete('/admin/departemen/destroy/{departemen:kodeDepartemen}', 'destroy');
});