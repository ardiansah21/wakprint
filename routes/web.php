<?php

use App\Http\Controllers\KonFileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\StoreProductRequest;

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






//test upload
Route::post('/konfigurasi/upload','MemberController@upload')->name('upload.file.home');






//pengelola
Route::prefix('partner')->name('partner.')->group(function(){
    Route::get('/', function () {
        return view('pengelola.homepage');
    })->name('home');
});











































// //Route::get('member', 'MemberController@profil');

// //tessjson
// Route::get('/testjson', 'ProductController@index');
// Route::get('/testjson/tambah', 'ProductController@tambah');
// Route::post('/testjson/store','ProductController@store');



