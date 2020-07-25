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


Route::get('/profil/alamat', 'MemberController@alamat')->name('alamat');

Route::get('/konfigurasi-pesanan', 'MemberController@konfigurasiPesanan')->name('konfigurasiPesanan');


//test upload
Route::post('/konfigurasi/upload','MemberController@upload')->name('upload.file.home');






//pengelola
// Route::prefix('partner')->name('partner.')->group(function(){
//     Route::get('/', function () {
//         return view('pengelola.homepage');
//     })->name('home');

//     Route::get('login','Auth\PartnerLoginController@showLoginForm')->name('login');
//     Route::post('login','Auth\PartnerLoginController@login');

//     Route::get('register', 'PartnerLoginController@showRegisterPage')->name('register');
//     Route::post('register', 'PartnerLoginController@register');
// });

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



// Route::get('pengelola/profil', function () {
//     return view('pengelola.profil');
// });

// Route::get('pesanan/detail', function () {
//     return view('pengelola.detail_pesanan_masuk');
// });

// Route::get('profil/edit', function () {
//     return view('pengelola.edit_profil');
// });

// Route::get('atk/tambah', function () {
//     return view('pengelola.tambah_atk');
// });

// Route::get('produk/tambah', function () {
//     return view('pengelola.tambah_produk');
// });

// Route::get('promo/tambah', function () {
//     return view('pengelola.tambah_promo');
// });

// Route::get('admin/login', function () {
//     return view('admin.login');
// });

// Route::get('admin', function () {
//     return view('admin.homepage');
// });





































// //Route::get('member', 'MemberController@profil');

// //tessjson
// Route::get('/testjson', 'ProductController@index');
// Route::get('/testjson/tambah', 'ProductController@tambah');
// Route::post('/testjson/store','ProductController@store');



