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
Broadcast::routes(['middleware' => ['auth:sanctum']]);

//member
Route::namespace ('API\Member')->prefix('v1')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'AuthController@logout');

        Route::get('/', 'MemberController@index');
    });
});

//partner
Route::namespace ('API\Partner')->prefix('v1/partner')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

    Route::middleware('auth:partner-api')->group(function () {
        Route::get('/logout', 'AuthController@logout');
        Route::get('/', 'PartnerController@index');
        Route::get('/user', 'PartnerController@user');
        Route::get('/saldo', 'PartnerController@saldoIndex');
        Route::get('/saldo/filter', 'PartnerController@filterSaldo');
        Route::get('/saldo/riwayat/{transaksiSaldo}', 'PartnerController@showSaldo');
        Route::post('/saldo/tarik/store', 'PartnerController@storeTarikSaldo');
        Route::post('/ubah-status', 'PartnerController@statusToko');
        Route::patch('/profil/update/{id}', 'PartnerController@profileUpdate');
        // Route::get('/pesanan', 'PesananController@index');
        // Route::get('/pesanan/detail/{id}', 'PesananController@detailPesanan');
        // Route::put('/pesanan/detail/terima/{id}', 'PesananController@terimaPesanan');
        // Route::get('/pesanan/detail/tolak/{id}', 'PesananController@tolakPesanan');
        // Route::get('/pesanan/detail/selesai/{id}', 'PesananController@selesaikanPesanan');

        Route::get('/pesanan/tolak/{pesanan}', 'PesananController@tolakPesanan');
        Route::get('/pesanan/selesaikan/{pesanan}', 'PesananController@selesaikanPesanan');
        Route::get('/pesanan/pesanan-masuk', 'PesananController@getPesananMasuk');
        Route::apiResource('/pesanan', 'PesananController');
        // Route::post('/pesanan/tolak/{id}', 'PesananController@tolakPesanan');
        // Route::apiResource('pesanan', 'PesananController');
        // Route::get('/pesanan/terima/{id}', 'PesananController@terimaPesanan');
        Route::apiResource('/atk', 'AtkController');
        Route::get('/produk/duplicate/{produkA}', 'ProdukController@duplicate');
        Route::apiResource('/produk', 'ProdukController');
        Route::put('/promo/store/{produk}', 'PromoController@store');
        Route::put('/promo/update/{produk}', 'PromoController@update');
        Route::put('/promo/delete/{produk}', 'PromoController@destroy');
        Route::apiResource('/promo', 'PromoController');
    });
});

//Notif
Route::prefix('v1/notif')->middleware('auth:' . activeGuard())->group(function () {
    Route::get('/', 'NotificationController@index');
    Route::post('read', 'NotificationController@read');
    Route::get('read-all', 'NotificationController@readAll');
});

//chat
Route::group(['prefix' => 'v1/chat'], function () {
    Route::get('pesanan', 'ChatController@pesanan');
    Route::get('message/{id}', 'ChatController@message');
    Route::get('message/{id}/read', 'ChatController@read');
    Route::post('message', 'ChatController@send');
});
