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

use App\Http\Controllers\API\Member\KonfigurasiController;

Broadcast::routes(['middleware' => ['auth:sanctum']]);

//member
Route::namespace ('API\Member')->prefix('v1')->group(function () {
    Route::get('/', 'MemberController@index');
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::get('/cari', 'MemberController@cari');
    Route::get('/produk', 'MemberController@produk');
    Route::get('/pengelola', 'MemberController@partner');
    Route::get('/partner/detail/{idPartner}', 'MemberController@detailPartner');
    Route::get('/produk/detail/{idProduk}', 'MemberController@detailProduk');

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'AuthController@logout');
        Route::get('/user', 'MemberController@user');
        Route::post('/produk/lapor/store/{idProduk}', 'MemberController@storeLaporProduk');
        Route::post('/profil/update', 'MemberController@updateProfile');
        Route::post('/profil/update-photo', 'MemberController@uploadPhotoProfile');
        Route::post('/profil/alamat/tambah/{idMember}', 'MemberController@tambahAlamat');
        Route::get('/profil/alamat/hapus/{idAlamat}', 'MemberController@hapusAlamat');
        Route::get('/profil/alamat/pilih/{idAlamat}', 'MemberController@pilihAlamat');
        Route::post('/profil/alamat/update/{idAlamat}', 'MemberController@editAlamat');
        Route::post('/favorit/tambah-favorit', 'MemberController@tambahFavorit');
        Route::get('/saldo', 'MemberController@saldo');
        Route::get('/saldo/filter', 'MemberController@filterSaldo');
        Route::get('/saldo/{transaksi_saldo}', 'MemberController@showSaldo');
        Route::get('/saldo/batalkan/{transaksi_saldo}', 'MemberController@batalTopUpSaldo');
        Route::post('/saldo/topup', 'MemberController@topUpSaldo');
        Route::get('/favorit', 'MemberController@favorit');
        Route::get('/ulasan', 'MemberController@ulasan');
        Route::get('/ulasan/sudah-diulas', 'MemberController@sudahDiulas');
        Route::get('/ulasan/ulas-produk/{pesanan}/{produk}', 'MemberController@showBelumDiulas');
        Route::post('/ulasan/store/{produk}', 'MemberController@storeUlasan');
        Route::post('/ulasan/upload-photo', 'MemberController@uploadPhotoUlasan');
        Route::get('/ulasan/ulasan-saya/{ulasan}/{produk}', 'MemberController@showSudahDiulas');
        Route::get('/ulasan/produk/{idProduk}', 'MemberController@ulasanProduk');
        Route::get('/pesanans/filter', 'PesananController@filterPesanan');
        Route::get('/pesanans/batalkan/{pesanan}', 'PesananController@batalkanPesanan');
        Route::get('/pesanans/selesaikan/{pesanan}', 'PesananController@selesaikanPesanan');
        Route::apiResource('/pesanans', 'PesananController');

        Route::post('/konfigurasi-file/cekwarna', 'KonfigurasiController@prosesCekWarna');
        Route::get('/konfigurasi-pesanan', 'KonfigurasiController@konfigurasiPesanan');
        Route::apiResource('/konfigurasi-file', 'KonfigurasiController');
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
        Route::post('/profil/update/{id}', 'PartnerController@profileUpdate');
        Route::post('/profil/store-media', 'PartnerController@storeMedia');
        Route::get('/pesanan/filter', 'PesananController@filterPesanan');
        Route::get('/pesanan/terima/{pesanan}', 'PesananController@terimaPesanan');
        Route::get('/pesanan/tolak/{pesanan}', 'PesananController@tolakPesanan');
        Route::get('/pesanan/selesai-cetak/{pesanan}', 'PesananController@selesaiCetakPesanan');
        Route::get('/pesanan/selesaikan/{pesanan}', 'PesananController@selesaikanPesanan');
        Route::apiResource('/pesanan', 'PesananController');
        Route::post('/atk/update/{atk}', 'AtkController@update');
        Route::apiResource('/atk', 'AtkController');
        Route::post('/produk/update/{produk}', 'ProdukController@updateProduk');
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
