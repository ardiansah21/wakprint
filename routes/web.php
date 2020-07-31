<?php

use App\Http\Controllers\KonFileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\StoreProductRequest;
use Illuminate\Support\Facades\Auth;

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

Route::get('/welcome', function () {
    return view('welcome');
});
Auth::routes();

    // temp dropzone
    Route::post('/users/fileupload/', 'MemberController@fileupload')->name('users.fileupload');

    //Route::post('/profil','MemberController@topUpSaldo')->name('profil.topup');

    //member

    Route::get('/', 'MemberController@index')->name('home');

    Route::get('produk', 'MemberController@produk')->name('produk');

    //test upload
    Route::post('/konfigurasi/upload','MemberController@upload')->name('upload.file.home');

    Route::middleware('auth')->group(function () {
        //TODO merapikan File Storage 2
        /*****/ Route::get('/konfigurasi-file', 'MemberController@konfigurasiFile')->name('konfigurasi.file');
        /*****/ Route::get('/konfigurasi-pesanan', 'MemberController@konfigurasiPesanan')->name('konfigurasiPesanan');
        
        Route::get('/profil', 'MemberController@profile')->name('profile');
        Route::get('profil/edit', 'MemberController@profileEdit')->name('profile.edit');
        Route::post('/profil/edit', 'MemberController@updateDataProfile');

        Route::get('profil/alamat', 'MemberController@alamat')->name('alamat');
        Route::post('profil/alamat/update', 'MemberController@editAlamat')->name('alamat.edit');
        Route::post('profil/alamat/tambah', 'MemberController@tambahAlamat')->name('alamat.tambah');
        Route::get('profil/alamat/hapus/{id}', 'MemberController@hapusAlamat')->name('alamat.hapus');

        Route::get('/ulasan/ulas', 'MemberController@ulas')->name('ulasan.ulas');
        Route::get('/ulasan/ulasan-saya', 'MemberController@ulasanSaya')->name('ulasan.ulasansaya');
    });


//Pengelola percetakan
Route::namespace('Partner')->prefix('partner')->name('partner.')->group(function () {

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegisterPage')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::middleware('auth:partner')->group(function(){
        Route::get('/','PartnerController@index')->name('home');
        Route::get('profil', 'PartnerController@profile')->name('profile');
        Route::get('profil/edit', 'PartnerController@profileEdit')->name('profile.edit');
        Route::post('profil/edit','PartnerController@profileUpdate');

        Route::get('tarik/saldo', 'PartnerController@tarikSaldo')->name('tarik.saldo');

        Route::resource('produk', 'ProdukController');
        Route::get('produk/create', 'ProdukController@create')->name('produk.create');
        Route::post('produk/store', 'ProdukController@store')->name('produk.store');
        Route::post('produk/media', 'ProdukController@storeMedia')->name('produk.storeMedia');
        
        Route::resource('pesanan', 'PesananController');
        Route::get('pesanan', 'PesananController@index')->name('detail.pesanan');

        Route::get('riwayat', 'PartnerController@riwayatTransaksi')->name('detail.riwayat');
        
        
        Route::resource('promo', 'PromoController');
        Route::get('promo/create', 'PromoController@create')->name('promo.create');

        Route::resource('atk', 'AtkController');
        Route::get('atk/create', 'AtkController@create')->name('atk.create');
    });
}); 


//Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function (){

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware('auth:admin')->group(function(){
        Route::get('/', 'AdminController@index')->name('home');
        Route::get('member/detail','Admin\AdminController@detailMember')->name('detail.member');
        Route::get('partner/detail','Admin\AdminController@detailPartner')->name('detail.partner');
        Route::get('saldo/tolak','Admin\AdminController@saldoTolak')->name('saldo.tolak');
        Route::get('keluhan/detail','Admin\AdminController@detailKeluhan')->name('detail.keluhan');
        //Route::post('member/{group_id}/datatables', ['as' => 'member.datatables','uses'=>'Admin\AdminController@memberByGroupDatatables']);
        //Route::post('user/{group_id}/datatables', ['as' => 'user.datatables','uses'=>'UserController@usersByGroupDatatables']);

        Route::get('member/json','AdminController@json');
    });
});

// //tessjson
Route::get('/testjson', 'ProductController@index');

// Route::get('table', 'ProductController@table');
Route::get('table', 'ProductController@table');
Route::get('table/json','ProductController@json');

Route::get('/testjson/tambah/', 'ProductController@tambah');
Route::post('/testjson/store', 'ProductController@store');
Route::get('/testjson/update/{id}', 'ProductController@updateShow');
Route::post('/testjson/update/{id}', 'ProductController@update');

Route::get('/index', 'SiteController@index');
Route::get('/index/create', 'SiteController@create');
Route::get('/index/edit/{id}', 'SiteController@edit')->name('edit');
Route::get('/index/show', 'SiteController@show')->name('show');
Route::post('/index/store', 'SiteController@store')->name('store');
Route::post('/index/update/{id}', 'SiteController@update')->name('update');
Route::post('/index/destroy/{id}', 'SiteController@destroy')->name('destroy');