<?php

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

//member
Route::namespace ('API\Member')->prefix('v1/member')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/logout', 'AuthController@logout');

        Route::get('/', 'MemberController@index');
    });
});

//partner
Route::namespace ('API\Partner')->prefix('v1/partner')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/logout', 'AuthController@logout');
        Route::get('/', 'PartnerController@index');

    });
});
