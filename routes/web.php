<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\VendorController;
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
Route::get('admin/show/vendor', [VendorController::class, 'show'])->name('show-vendor');
Route::get('admin/reject/vendor/{id}', [VendorController::class, 'reject'])->name('reject/vendor');
Route::get('admin/approve/{id}', [VendorController::class, 'aprove'])->name('approve/vendor');
Route::get('admin/all/vendor', [VendorController::class, 'all'])->name('all-vendor');
Route::get('admin/delete/copen/{id}', [CouponController::class, 'delete'])->name('delete/copen');
Route::post('admin/edit/copen/{id}', [CouponController::class, 'update'])->name('edit-copen');
Route::get('admin/all/copen', [CouponController::class, 'show'])->name('all-copen');