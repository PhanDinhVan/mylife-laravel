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

        // Booking
        Route::get('booking', 'API\BookingController@index')->name('getBooking');
        Route::post('booking', 'API\BookingController@store')->name('createBooking');
        Route::patch('booking/{id}', 'API\BookingController@update')->name('updateSBooking');
        Route::delete('booking/delete/{id}', 'API\BookingController@destroy')->name('deleteBooking');

        // Promotion
        Route::get('promotion', 'API\PromotionController@index')->name('getPromotion');
        Route::post('promotion', 'API\PromotionController@store')->name('createPromotion');

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
        // Route::post('booking', 'API\BookingController@store')->name('createBooking');
        // Route::patch('booking/{id}', 'API\BookingController@update')->name('updateSBooking');
        // Route::delete('booking/delete/{id}', 'API\BookingController@destroy')->name('deleteBooking');
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

        // Staff
        Route::post('staff/create', 'API\StaffController@store')->name('createStaff');
        Route::post('staff/update', 'API\StaffController@update')->name('updateStaff');
        Route::get('staff', 'API\StaffController@index')->name('staff');
        Route::delete('staff/delete/{id}', 'API\StaffController@destroy')->name('deleteStaff');
        Route::get('roles', 'API\StaffController@getRoles')->name('getRoles');
    });
});