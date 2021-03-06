<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => 'cors',
    'prefix' => 'v1'
], function () {
    Route::get('status', function () {
        return response()->json([
            'version' => getenv('API_VERSION', '1.0'),
            'database' => 'good'
        ]);
    })->name('serverStatus');

    Route::group([

        'middleware' => 'api',
        'prefix' => 'auth'

    ], function ($router) {

        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
        Route::post('register', 'ProfileController@store')->name('authRegister');
    });

    Route::get('roles', 'RoleController@index')->name('roleIndex');
    Route::post('roles', 'RoleController@store')->name('createRole');
    Route::patch('roles/{id}', 'RoleController@update')->name('updateRole');
    Route::delete('roles/delete/{id}', 'RoleController@destroy')->name('deleteRole');


    Route::group([
        'middleware' => 'jwt.auth'
    ], function ($router) {
        // Company
        Route::get('companies', 'API\CompanyController@index')->name('companies');

        // Shop
        Route::get('shop', 'API\ShopController@index')->name('shops');
        Route::patch('shop/{id}', 'API\ShopController@update')->name('updateShops');
        Route::get('shopBooking', 'API\ShopController@getShopBooking')->name('getShopBooking');

        // Booking
        Route::get('booking', 'API\BookingController@index')->name('getBooking');
        Route::post('booking', 'API\BookingController@store')->name('createBooking');
        Route::patch('booking/{id}', 'API\BookingController@update')->name('updateSBooking');
        Route::delete('booking/delete/{id}', 'API\BookingController@destroy')->name('deleteBooking');

        // Promotion
        Route::get('promotion', 'API\PromotionController@index')->name('getPromotion');
        Route::post('promotion', 'API\PromotionController@store')->name('createPromotion');
        Route::patch('promotion/{id}', 'API\PromotionController@update')->name('updatePromotion');

        // News
        Route::get('news', 'API\NewsController@index')->name('getNews');
        Route::post('news', 'API\NewsController@store')->name('createNews');
        Route::post('update', 'API\NewsController@update')->name('updateNews');
        Route::delete('news/delete/{id}', 'API\NewsController@destroy')->name('deleteNews');

        // Menu Category
        Route::post('create-menu-category', 'API\MenuCategoryController@store')->name('createMenuCategory');

        // Menu
        Route::post('create-menu', 'API\MenuController@store')->name('createMenu');
        Route::get('get-menu', 'API\MenuController@index')->name('getMenu');

        // Booking Manager
        Route::get('booking_manager', 'API\BookingManagerController@index')->name('getBookingManager');
        Route::post('booking_manager', 'API\BookingManagerController@store')->name('createBookingManager');
        Route::get('user_booking', 'API\BookingManagerController@userBooking')->name('getUserBooking');
        Route::patch('booking_manager/{id}', 'API\BookingManagerController@update')->name('updateBookingManager');
        Route::delete('booking_manager/delete/{id}', 'API\BookingManagerController@destroy')->name('deleteBookingManager');

        // Review
        Route::get('review', 'API\ReviewController@index')->name('getReview');
        Route::post('review', 'API\ReviewController@store')->name('createReview');
        Route::delete('review/delete/{id}', 'API\ReviewController@destroy')->name('deleteReview');

        // Review Booking Manager
        Route::get('review_bmanager', 'API\ReviewBookingManagerController@index')->name('getReviewBManager');
        Route::post('review_bmanager', 'API\ReviewBookingManagerController@store')->name('createReviewBManager');
        Route::patch('review_bmanager/{id}', 'API\ReviewBookingManagerController@update')->name('updateReviewBookingManager');
        Route::delete('review_bmanager/delete/{id}', 'API\ReviewBookingManagerController@destroy')->name('deleteReviewBManager');
    });

    Route::group([
        'middleware' => 'jwt.auth',
        'prefix' => 'admin'
    ], function ($router) {
        // User
        Route::get('users', 'API\UserController@index')->name('users');
        Route::delete('delete/{id}', 'API\UserController@destroy')->name('deleteUser');
        Route::post('update', 'API\UserController@update')->name('updateUser');
        Route::post('create', 'API\UserController@store')->name('createUser');

        // Employee
        Route::post('employee/create', 'API\EmployeeController@store')->name('createEmployee');
        Route::post('employee/update', 'API\EmployeeController@update')->name('updateEmployee');
        Route::get('employee', 'API\EmployeeController@index')->name('getEmployee');
        Route::delete('employee/delete/{id}', 'API\EmployeeController@destroy')->name('deleteEmployee');
        Route::get('roles', 'API\EmployeeController@getRoles')->name('getRoles');
    });
});