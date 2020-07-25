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

Route::get('/', 'HomeController@index')->name('home'); 

Route::redirect('/home','/');

//dropzone
Route::post('/users/fileupload/','HomeController@fileupload')->name('users.fileupload');



// Sudah Auth

Route::get('/profil', 'MemberController@profile')->name('profile');  

Route::get('/konfigurasi-file', 'MemberController@konfigurasiFile')->name('konfigurasi.file');
Route::get('/konfigurasi-file/showPDF/{path}', 'MemberController@showPdf')->name('showPDF');

///tempat nambah
// Route::get('/profil/edit/{id}', 'MemberController@editProfile')->name('profile.edit');

Route::get('profil/edit', 'MemberController@profileEdit')->name('profile.edit');
Route::post('/profil/edit','MemberController@updateDataProfile');



Route::get('/alamat', 'MemberController@alamat')->name('alamat');
Route::post('/alamat/update','MemberController@editAlamat')->name('alamat.edit');
Route::post('/alamat/tambah','MemberController@tambahAlamat')->name('alamat.tambah');

Route::get('/konfigurasi-pesanan', 'MemberController@konfigurasiPesanan')->name('konfigurasiPesanan');


//test upload
Route::post('/konfigurasi/upload','MemberController@upload')->name('upload.file.home');



//Pengelola percetakan
Route::prefix('partner')->name('partner.')->group(function(){

    Route::get('login','Partner\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login','Partner\Auth\LoginController@login');
    Route::post('logout', 'Partner\Auth\LoginController@logout')->name('logout');

    Route::get('register', 'Partner\Auth\RegisterController@showRegisterPage')->name('register');
    Route::post('register', 'Partner\Auth\RegisterController@register');

    Route::middleware('auth:partner')->group(function(){
        Route::get('/','PartnerController@index')->name('home');
    });


});


// //tessjson
Route::get('/testjson', 'ProductController@index');

Route::get('/testjson/tambah/', 'ProductController@tambah');
Route::post('/testjson/store','ProductController@store');


Route::get('/testjson/update/{id}', 'ProductController@updateShow');
Route::post('/testjson/update/{id}', 'ProductController@update');


