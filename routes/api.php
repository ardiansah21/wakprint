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
        Route::get('/user', 'MemberController@user');
        Route::post('/profil/update', 'MemberController@updateProfile');
        Route::get('/saldo', 'MemberController@saldo');
        Route::get('/saldo/filter', 'MemberController@filterSaldo');
        Route::get('/saldo/{transaksi_saldo}', 'MemberController@showSaldo');

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
        Route::post('/profil/store-media', 'PartnerController@storeMedia');
        Route::get('/pesanan/filter', 'PesananController@filterPesanan');
        Route::get('/pesanan/terima/{pesanan}', 'PesananController@terimaPesanan');
        Route::get('/pesanan/tolak/{pesanan}', 'PesananController@tolakPesanan');
        Route::get('/pesanan/selesai-cetak/{pesanan}', 'PesananController@selesaiCetakPesanan');
        Route::get('/pesanan/selesaikan/{pesanan}', 'PesananController@selesaikanPesanan');
        Route::apiResource('/pesanan', 'PesananController');
        Route::post('/atk/update/{atk}', 'AtkController@update');
        Route::apiResource('/atk', 'AtkController');
        Route::get('/produk/duplicate/{produkA}', 'ProdukController@duplicate');
        Route::apiResource('/produk', 'ProdukController');
        Route::patch('/promo/store/{id}', 'PromoController@store');
        Route::patch('/promo/update/{produk}', 'PromoController@update');
        Route::get('/promo/delete/{produk}', 'PromoController@destroy');
        Route::get('/promo/filter-produk', 'PromoController@filterPromo');
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
