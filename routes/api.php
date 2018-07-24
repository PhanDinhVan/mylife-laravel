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


    Route::group([
        'middleware' => 'jwt.auth'
    ], function ($router) {
        // Company
        Route::get('companies', 'API\CompanyController@index')->name('companies');

        // Shop
        Route::get('shop', 'API\ShopController@index')->name('shops');
        Route::patch('shop/{id}', 'API\ShopController@update')->name('updateShops');

        // Booking
        Route::get('booking', 'API\BookingController@index')->name('getBooking');
        Route::post('booking', 'API\BookingController@store')->name('createBooking');
        Route::patch('booking/{id}', 'API\BookingController@update')->name('updateSBooking');

        // Promotion
        Route::get('promotion', 'API\PromotionController@index')->name('getPromotion');
        Route::post('promotion', 'API\PromotionController@store')->name('createPromotion');

        // News
        Route::get('news', 'API\NewsController@index')->name('getNews');
        Route::post('news', 'API\NewsController@store')->name('createNews');
    });

    Route::group([
        'middleware' => 'jwt.auth',
        'prefix' => 'admin'
    ], function ($router) {
        // User
        Route::get('users', 'API\UserController@index')->name('users');
    });
});