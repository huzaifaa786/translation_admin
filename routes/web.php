<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BugController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SaleController;
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
Route::get('admin/disable/{id}', [VendorController::class, 'disable'])->name('disable/vendor');
Route::get('admin/all/vendor', [VendorController::class, 'all'])->name('all-vendor');
Route::get('admin/enable/vendor', [VendorController::class, 'enableVendor'])->name('enableVendor');
Route::get('admin/disable/vendor', [VendorController::class, 'disableVendor'])->name('disableVendor');
Route::get('admin/delete/copen/{id}', [CouponController::class, 'delete'])->name('delete/copen');
Route::post('admin/edit/copen/{id}', [CouponController::class, 'update'])->name('edit-copen');
Route::get('admin/all/copen', [CouponController::class, 'show'])->name('all-copen');
Route::any('copen', [CouponController::class, 'shows'])->name("companycopen");
Route::any('bugs', [BugController::class, 'index'])->name("bug.index");
Route::any('copensave', [CouponController::class, 'store'])->name("savecopen");
Route::get('admin/vendor/all/sales', [SaleController::class, 'allsales'])->name('allsales');
Route::get('admin/vendor/salesall', [SaleController::class, 'companysales'])->name('companysales');
Route::get('admin/company/users', [CompanyController::class, 'index'])->name('companyUsers');
Route::post('admin/store/company/user', [CompanyController::class, 'store'])->name('storeCompanyUser');

