<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\FavoritiesController;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\VendorOtpController;
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
    Route::any('userget', [AuthController::class, 'getuser']);
    Route::any('otplogin', [AuthController::class, 'otplogin']);

    Route::any('vendor/show', [VendorController::class, 'show']);
    Route::any('service/get', [ServiceController::class, 'serviceget']);
    Route::any('ratting/get', [OrderController::class, 'orderrating']);



    Route::any('payment/intent', [PaymentController::class, 'createPaymentIntent']);
    Route::any('add/bug', [UserController::class, 'addbug']);
    Route::any('vendor/calrating', [RatingController::class, 'calculate']);
    Route::any('forgetuserpassword', [OtpController::class, 'sendopt']);
    Route::any('forgetchangepassword', [OtpController::class, 'forgetchange']);


    Route::group(['middleware' => 'auth:vendor_api'], function () {
        Route::any('currency/store', [VendorController::class, 'updatePreferredCurrency']);
        Route::any('country/store', [VendorController::class, 'setCountry']);
        Route::any('service/store', [ServiceController::class, 'store']);
        Route::any('vendor/online', [VendorController::class, 'offline']);
        Route::any('vendor/update', [VendorController::class, 'edit']);
        Route::any('order/accept', [OrderController::class, 'accept']);
        Route::any('order/reject', [OrderController::class, 'reject']);
        Route::any('order/complete', [OrderController::class, 'complete']);
        Route::any('vendor/order', [OrderController::class, 'vendororder']);
        Route::any('vendor/sale', [ReportController::class, 'sales']);
        Route::any('vendor/weekly', [ReportController::class, 'weeklysale']);
        Route::any('vendor/notification', [NotificationController::class, 'vendornotification']);
        Route::any('notification/check', [NotificationController::class, 'check']);
        Route::any('notification/read', [NotificationController::class, 'read']);
        Route::any('vendor/changepassword', [AuthController::class, 'changevendorrpassword']);
    });
    Route::any('forgetvendorpassword', [VendorOtpController::class, 'sendopt']);
    Route::any('vendorforgetchangepassword', [VendorOtpController::class, 'forgetchange']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::any('user/currency/store', [UserController::class, 'updatePreferredCurrency']);
        Route::any('user/country/store', [UserController::class, 'setCountry']);
        Route::any('getcoupon', [CouponController::class, 'coupon']);
        Route::any('balance/get', [UserController::class, 'balanceget']);
        Route::any('order/checkAvailability', [AvailabilityController::class, 'checkAvailability']);
        Route::any('balance/add', [VendorController::class, 'addbalance']);
        Route::any('user/get', [UserController::class, 'userget']);
        Route::any('user/order', [OrderController::class, 'order']);
        Route::any('order/get', [OrderController::class, 'allorder']);
        Route::any('user/changepassword', [AuthController::class, 'changeuserpassword']);
        Route::any('user/update', [UserController::class, 'edituser']);
        Route::any('user/notification', [NotificationController::class, 'usernotification']);
        Route::any('user/rating', [RatingController::class, 'rating']);
        Route::any('user/schedule', [AvailabilityController::class, 'order']);
        Route::any('add/favorities', [FavoritiesController::class, 'store']);
        Route::any('get/favorities', [FavoritiesController::class, 'getfavorities']);
        Route::any('check/favorities', [FavoritiesController::class, 'checkfavorit']);
        Route::any('vendor/search', [VendorController::class, 'searchedList']);
        Route::any('check/favorities', [FavoritiesController::class, 'userCheck']);
        Route::any('balanceshow', [AccountController::class, 'show']);
        Route::any('user/check', [NotificationController::class, 'usercheck']);
        Route::any('balancesubtract', [AccountController::class, 'subtract']);
        Route::any('usernotification/read', [NotificationController::class, 'userread']);
    });

    Route::group(['middleware' => 'or'], function () {
        /**
         * Authentication for pusher private channels
         */
        Route::post('/chat/auth', 'MessagesController@pusherAuth')->name('api.pusher.auth');

        /**
         *  Fetch info for specific id [user/group]
         */
        Route::post('/idInfo', 'MessagesController@idFetchData')->name('api.idInfo');

        /**
         * Send message route
         */
        Route::post('/sendMessage', 'MessagesController@send')->name('api.send.message');

        /**
         * Fetch messages
         */
        Route::post('/fetchMessages', 'MessagesController@fetch')->name('api.fetch.messages');

        /**
         * Download attachments route to create a downloadable links
         */
        Route::get('/download/{fileName}', 'MessagesController@download')->name('api.' . config('chatify.attachments.download_route_name'));

        /**
         * Make messages as seen
         */
        Route::post('/makeSeen', 'MessagesController@seen')->name('api.messages.seen');
        Route::post('/unseen/all', 'MessagesController@getUnSeenCount')->name('api.messages.unseen');

        /**
         * Get contacts
         */
        Route::any('/getContacts', 'MessagesController@getContacts')->name('api.contacts.get');

        /**
         * Star in favorite list
         */
        Route::post('/star', 'MessagesController@favorite')->name('api.star');

        /**
         * get favorites list
         */
        Route::post('/favorites', 'MessagesController@getFavorites')->name('api.favorites');

        /**
         * Search in messenger
         */
        Route::get('/search', 'MessagesController@search')->name('api.search');

        /**
         * Get shared photos
         */
        Route::post('/shared', 'MessagesController@sharedPhotos')->name('api.shared');

        /**
         * Delete Conversation
         */
        Route::post('/deleteConversation', 'MessagesController@deleteConversation')->name('api.conversation.delete');

        /**
         * Delete Conversation
         */
        Route::post('/updateSettings', 'MessagesController@updateSettings')->name('api.avatar.update');

        /**
         * Set active status
         */
        Route::post('/setActiveStatus', 'MessagesController@setActiveStatus')->name('api.activeStatus.set');
    });
});
