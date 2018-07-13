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

    Route::get('roles', 'RoleController@index')->name('roleIndex');

    Route::prefix('auth')->group(function() {
        Route::post('register', 'ProfileController@store')->name('authRegister');
    });
});