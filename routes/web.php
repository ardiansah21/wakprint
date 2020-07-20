<?php

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

// Route::get('/', function () {
//     return view('member.homepage');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home'); 

Route::redirect('/home','/');

// Sudah Auth

Route::get('/profil', 'MemberController@profile')->name('profile'); 


//
// Route::get('masuk', function () {
//     return view('member.auth.login');
// });

// Route::get('daftar', function () {
//     return view('member.register');
// });

// Route::get('homepage', function () {
//     return view('member.homepage');
// });

// Route::get('alamat', function () {
//     return view('member.alamat');
// });

// Route::get('ulasan', function () {
//     return view('member.ulasan');
// });

// Route::get('ulasan-saya', function () {
//     return view('member.ulasan_saya');
// });

// Route::get('ulasan-produk', function () {
//     return view('member.ulasan_produk_pengelola');
// });

// Route::get('ulas', function () {
//     return view('member.ulas_produk');
// });

// Route::get('profil', function () {
//     return view('member.profil');
// });

// Route::get('edit-profil', function () {
//     return view('member.edit_profil');
// });

// Route::get('faq', function () {
//     return view('member.faq');
// });

// Route::get('chat', function () {
//     return view('member.chat');
// });

// Route::get('pencarian', function () {
//     return view('member.pencarian');
// });






































// //Route::get('member', 'MemberController@profil');

// //tessjson
// Route::get('/testjson', 'ProductController@index');
// Route::get('/testjson/tambah', 'ProductController@tambah');
// Route::post('/testjson/store','ProductController@store');




// // Route::get('/', 'MemberController@index');
// Route::get('/member/login', 'MemberController@login');
// Route::get('/member/register', 'MemberController@register');
// Route::get('/member/{id_member?}/profil', 'MemberController@profil');
// Route::get('/member/{id_member?}/profil/edit', 'MemberController@profit_edit');
// Route::get('/member/{id_member?}/profil/pesanan', 'MemberController@pesanan');
// Route::get('/member/{id_member?}/profil/riwayat', 'MemberController@riwayat');
// Route::get('/member/{id_member?}/profil/saldo', 'MemberController@saldo');
// Route::get('/member/{id_member?}/profil/favorit', 'MemberController@favorit');
// Route::get('/member/{id_member?}/profil/ulasan', 'MemberController@ulasan');
// Route::get('/member/{id_member?}/profil/ulas', 'MemberController@ulas');


// // '{{ url('/member/'.$member->id_member.'/konfigurasi-pesanan') }}'


// //start
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home'); 


