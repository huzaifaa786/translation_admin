<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {

    Route::any('vendor/register', [AuthController::class, 'vendorregister']);

    Route::any('vendor/login', [AuthController::class, 'vendorlogin']);
 
    Route::group(['middleware' => 'auth:vendor_api'], function () {

    Route::any('vendor/online', [VendorController::class, 'offline']);
    Route::any('vendor/get', [VendorController::class, 'vendorget']);
    });
});
