<?php

use App\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\StoreProductRequest;
use App\Http\Controllers\KonFileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/welcome', function () {
//     return view('welcome');
// });
Auth::routes();

/////
Route::post('/upload-pdf', 'MemberController@uploadPdf')->name('upload.pdf');

Route::post('/uploaddd', 'MemberController@uploadtes')->name('upload.test');
/////

// temp dropzone
Route::post('/users/fileupload/', 'MemberController@fileupload')->name('users.fileupload');

//Route::post('/profil','MemberController@topUpSaldo')->name('profil.topup');

Route::get('produk', 'MemberController@produk')->name('produk');
Route::any('pencarian', 'MemberController@pencarian')->name('pencarian');
Route::get('pencariantes', 'MemberController@pencarianTes')->name('pencariantes');
Route::get('partner/detail/{id}', 'MemberController@detailPartner')->name('detail.partner');
Route::get('produk/detail/{id}', 'MemberController@detailProduk')->name('detail.produk');
Route::get('faq', 'MemberController@faq')->name('faq');
Route::get('tentang', 'MemberController@tentang')->name('tentang');
//member

Route::get('/', 'MemberController@index')->name('home');

Route::get('pencarian/cari', 'MemberController@cari')->name('cari');
Route::post('search', 'SearchController@search')->name('search');

//test upload
// Route::post('/konfigurasi/upload', 'MemberController@upload')->name('upload.file.home');

// Route::get('/tesproduk', function () {
//     $produk = Produk::all();
//     return view('member.card_produk', compact('produk'));
// });

Route::middleware('auth')->group(function () {
    //TODO merapikan File Storage 2
    /*****/Route::get('/konfigurasi-file/{pdf}', 'MemberController@konfigurasiFile')->name('konfigurasi.file');
    Route::post('/konfigurasi/upload', 'MemberController@upload')->name('upload.file.home');
    /*****/Route::get('/konfigurasi-pesanan', 'MemberController@konfigurasiPesanan')->name('konfigurasi.pesanan');

    Route::get('/profil', 'MemberController@profile')->name('profile');
    Route::get('profil/edit', 'MemberController@profileEdit')->name('profile.edit');
    Route::post('/profil/edit', 'MemberController@updateDataProfile');

    Route::get('profil/alamat', 'MemberController@alamat')->name('alamat');
    Route::post('profil/alamat/update', 'MemberController@editAlamat')->name('alamat.edit');
    Route::post('profil/alamat/tambah', 'MemberController@tambahAlamat')->name('alamat.tambah');
    Route::get('profil/alamat/hapus/{id}', 'MemberController@hapusAlamat')->name('alamat.hapus');
    Route::get('profil/alamat/pilih/{id}', 'MemberController@pilihAlamat')->name('alamat.pilih');
    Route::get('saldo', 'MemberController@saldo')->name('saldo');
    Route::post('saldo/topup', 'MemberController@topUpSaldo')->name('saldo.topup');
    Route::get('saldo/pembayaran/{id}', 'MemberController@saldoPembayaran')->name('saldo.pembayaran');
    Route::get('saldo/riwayat/{id}', 'MemberController@riwayatSaldo')->name('riwayat.saldo');

    Route::get('riwayat', 'MemberController@riwayat')->name('riwayat');

    Route::get('konfigurasi-pesanan', 'MemberController@konfigurasiPesanan')->name('konfigurasi.pesanan');
    Route::get('konfirmasi-pembayaran', 'MemberController@konfirmasiPembayaran')->name('konfirmasi.pembayaran');

    Route::get('pesanan', 'MemberController@pesanan')->name('pesanan');
    Route::get('pesanan/detail', 'MemberController@detailPesanan')->name('pesanan.detail');

    Route::get('favorit', 'MemberController@favorit')->name('favorit');
    Route::post('favorit/status/{id}', 'MemberController@tambahFavorit')->name('favorit.status');

    Route::get('ulasan', 'MemberController@ulasan')->name('ulasan');
    Route::get('/ulasan/ulas/{id}', 'MemberController@ulas')->name('ulasan.ulas');
    Route::get('/ulasan/ulasan-saya', 'MemberController@ulasanSaya')->name('ulasan.ulasansaya');
    Route::get('ulasan/partner/{id}', 'MemberController@ulasanPartner')->name('ulasan.partner');

    Route::get('chat', 'MemberController@chat')->name('chat');

    Route::get('produk/lapor/{id}', 'MemberController@laporProduk')->name('produk.lapor');
    Route::post('produk/lapor/store/{id}', 'MemberController@storeLapor')->name('lapor.store');
});

//Pengelola percetakan
Route::namespace ('Partner')->prefix('partner')->name('partner.')->group(function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegisterPage')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::middleware('auth:partner')->group(function () {
        Route::get('/', 'PartnerController@index')->name('home');
        Route::get('profil', 'PartnerController@profile')->name('profile');
        Route::get('profil/edit', 'PartnerController@profileEdit')->name('profile.edit');
        Route::post('profil/edit', 'PartnerController@profileUpdate');

        Route::get('saldo', 'PartnerController@saldo')->name('saldo');
        Route::get('saldo/tarik', 'PartnerController@tarikSaldo')->name('saldo.tarik');
        Route::post('saldo/tarik/store', 'PartnerController@storeTarikSaldo')->name('saldo.tarik.store');

        Route::resource('produk', 'ProdukController');
        Route::post('produk/media', 'ProdukController@storeMedia')->name('produk.storeMedia');
        Route::get('produk/duplicate/{id}', 'ProdukController@duplicate')->name('produk.duplicate');

        Route::get('pesanan', 'PesananController@index')->name('pesanan');
        Route::get('pesanan/detail', 'PesananController@detailPesanan')->name('detail.pesanan');

        Route::get('riwayat/{id}', 'PartnerController@riwayatTransaksi')->name('riwayat.saldo');

        Route::resource('promo', 'PromoController');
        Route::post('promo/store', 'PromoController@store');

        Route::resource('atk', 'AtkController');

        Route::get('info', 'PartnerController@info')->name('info');
        Route::post('ubah-status', 'PartnerController@statusToko')->name('ubah-status');

        Route::post('filter/riwayat', 'PartnerController@filterSaldo')->name('filter.riwayat');
        Route::post('search/produk', 'PromoController@searchProdukPartner')->name('search.produk');
    });
});

//Admin
Route::namespace ('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', 'AdminController@index')->name('home');
        Route::get('/member', 'AdminController@dataMember')->name('member');
        Route::get('member/detail/{id}', 'AdminController@detailMember')->name('member.detail');
        Route::post('member/hapus/{id}', 'AdminController@hapusMember')->name('member.hapus');
        Route::get('/partner', 'AdminController@dataPartner')->name('partner');
        Route::get('/partner/tolak/{id}', 'AdminController@tolakPartner')->name('partner.tolak');
        Route::get('partner/detail/{id}', 'AdminController@detailPartner')->name('partner.detail');
        Route::post('partner/terima/{id}', 'AdminController@terimaPartner')->name('partner.terima');
        Route::get('/saldo', 'AdminController@dataSaldo')->name('saldo');
        Route::get('saldo/tolak', 'AdminController@saldoTolak')->name('saldo.tolak');
        Route::get('/keluhan', 'AdminController@keluhan')->name('keluhan');
        Route::get('keluhan/detail/{id}', 'AdminController@detailKeluhan')->name('detail.keluhan');
        Route::get('keluhan/tanggapi/{id}', 'AdminController@tanggapiKeluhan')->name('keluhan.tanggapi');
        //Route::post('member/{group_id}/datatables', ['as' => 'member.datatables','uses'=>'Admin\AdminController@memberByGroupDatatables']);
        //Route::post('user/{group_id}/datatables', ['as' => 'user.datatables','uses'=>'UserController@usersByGroupDatatables']);

        Route::get('member/json', 'AdminController@memberJson')->name('member.json');
        Route::get('partner/json', 'AdminController@partnerJson')->name('partner.json');
        Route::get('saldo/json', 'AdminController@saldoJson')->name('saldo.json');
        Route::get('keluhan/json', 'AdminController@keluhanJson')->name('keluhan.json');
    });
});

// //tessjson
Route::get('/testjson', 'ProductController@index');

// Route::get('table', 'ProductController@table');
Route::get('table', 'ProductController@table');
Route::get('carousel', 'ProductController@carousel');
Route::get('table/json', 'ProductController@json');

Route::get('/testjson/tambah/', 'ProductController@tambah');
Route::post('/testjson/store', 'ProductController@store');
Route::get('/testjson/update/{id}', 'ProductController@updateShow');
Route::post('/testjson/update/{id}', 'ProductController@update');

Route::get('foto', 'ProductController@foto');

// Route::get('/index', 'SiteController@index');
// Route::get('/index/create', 'SiteController@create');
// Route::get('/index/edit/{id}', 'SiteController@edit')->name('edit');
// Route::get('/index/show', 'SiteController@show')->name('show');
// Route::post('/index/store', 'SiteController@store')->name('store');
// Route::post('/index/update/{id}', 'SiteController@update')->name('update');
// Route::post('/index/destroy/{id}', 'SiteController@destroy')->name('destroy');

//TEMP
Route::resource('pdf', 'PdfController');

// Route::get('testing', function () {
//     return view('pengujian3');
// });

Route::post('store2', 'PdfController@store2')->name('store2');

// Route::get('/konfigurasi-file', 'MemberController@tesKonfigurasiFile')->name('tes.konfigurasi.file');

//PENGUJIAN
Route::get('pengujian', 'PengujianController@index')->name('pengujian');
Route::post('pengujian/store', 'PengujianController@store')->name('pengujian.store');
Route::post('pengujian/proses', 'PengujianController@proses')->name('pengujian.proses');
