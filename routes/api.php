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


Route::prefix('v1')->group(function () {
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
    });
});