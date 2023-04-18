<?php

use App\Http\Controllers\Admin\DepartemenController;
use App\Http\Controllers\Admin\HomeController;
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

Route::controller(UserController::class)->group(function() {
    Route::get('/admin/user', 'index');
    Route::get('/admin/user/create', 'create');
    Route::post('/admin/user/store', 'store');
});

Route::controller(DepartemenController::class)->group(function() {
    Route::get('/admin/departemen', 'index');
});