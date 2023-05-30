<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
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
    Route::any('user/login', [AuthController::class, 'userlogin']);
    Route::any('user/register', [AuthController::class, 'userregister']);
    // search list
    Route::any('vendor/search', [VendorController::class, 'searchedList']);
    Route::any('vendor/show', [VendorController::class, 'show']);
    Route::any('service/get', [ServiceController::class, 'serviceget']);



    Route::any('payment/intent', [PaymentController::class, 'createPaymentIntent']);
    Route::any('add/bug', [UserController::class, 'addbug']);

    Route::group(['middleware' => 'auth:vendor_api'], function () {

        Route::any('service/store', [ServiceController::class, 'store']);
        Route::any('vendor/online', [VendorController::class, 'offline']);
        Route::any('vendor/update', [VendorController::class, 'edit']);
        Route::any('order/accept', [OrderController::class, 'accept']);
        Route::any('order/reject', [OrderController::class, 'reject']);
        Route::any('order/complete', [OrderController::class, 'complete']);
        Route::any('vendor/order', [OrderController::class, 'vendororder']);
        Route::any('vendor/changepassword', [AuthController::class, 'changevendorrpassword']);
    });
    Route::group(['middleware' => 'auth:api'], function () {
        Route::any('balance/get', [UserController::class, 'balanceget']);
        Route::any('balance/add', [VendorController::class, 'addbalance']);
        Route::any('user/get', [UserController::class, 'userget']);
        Route::any('user/order', [OrderController::class, 'order']);
        Route::any('order/get', [OrderController::class, 'allorder']);
        Route::any('user/changepassword', [AuthController::class, 'changeuserpassword']);
        Route::any('user/update', [UserController::class, 'edituser']);
    });
});
