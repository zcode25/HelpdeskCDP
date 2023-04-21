<?php

use App\Http\Controllers\Admin\DepartemenController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TiketContoller;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
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

Route::controller(TiketContoller::class)->group(function() {
    Route::get('/admin/tiket', 'index');
    Route::get('/admin/tiket/konfirmasi/CDP/IT/20/04/23/0001', 'konfirmasi');
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