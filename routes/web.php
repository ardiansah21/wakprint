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


//member
{
    Route::get('/', 'MemberController@index')->name('home');

    //TODO merapikan File Storage
    /*****/ Route::get('/konfigurasi-file/showPDF/{path}', 'MemberController@showPdf')->name('showPDF');
    /*****/ Route::post('/konfigurasi/upload', 'MemberController@upload')->name('upload.file.home');


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
    });
}


//Pengelola percetakan
Route::namespace('Partner')->prefix('partner')->name('partner.')->group(function () {

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Auth\RegisterController@showRegisterPage')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::middleware('auth:partner')->group(function () {
        Route::get('/', 'PartnerController@index')->name('home');

        Route::resource('produk', 'ProdukController');
        Route::post('produk/media', 'ProdukController@storeMedia')->name('produk.storeMedia');

        Route::resource('promo', 'PromoController');
        Route::resource('atk', 'AtkController');
    });
});


//Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', 'AdminController@index')->name('home');
    });
});





// //tessjson
Route::get('/testjson', 'ProductController@index');
Route::get('/testjson/tambah/', 'ProductController@tambah');
Route::post('/testjson/store', 'ProductController@store');
Route::get('/testjson/update/{id}', 'ProductController@updateShow');
Route::post('/testjson/update/{id}', 'ProductController@update');
