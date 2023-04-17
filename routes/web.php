<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
 
});
Route::view('admin/login','admin.login')->name('admin/login');
Route::post('admin/postlogin', [AdminController::class, 'login'])->name('admin-login');
Route::view('admin/layout','admin.layout')->name('admin/layout');
Route::view('admin/dashboard','admin.dashboard')->name('login.dashboard');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin/logout');
