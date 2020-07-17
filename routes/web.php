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

Route::get('/', function () {
    return view('member.homepage');
});

Route::redirect('/index', '/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); 


Route::get('coba', function () {
    return view('layouts.member');
});
Route::get('cobaLogin', function () {
    return view('member.auth.login');
});

// Route::group(base_path('routes/member.php'));







































//Route::get('member', 'MemberController@profil');

//tessjson
Route::get('/testjson', 'ProductController@index');
Route::get('/testjson/tambah', 'ProductController@tambah');
Route::post('/testjson/store','ProductController@store');




// Route::get('/', 'MemberController@index');
Route::get('/member/login', 'MemberController@login');
Route::get('/member/register', 'MemberController@register');
Route::get('/member/{id_member?}/profil', 'MemberController@profil');
Route::get('/member/{id_member?}/profil/edit', 'MemberController@profit_edit');
Route::get('/member/{id_member?}/profil/pesanan', 'MemberController@pesanan');
Route::get('/member/{id_member?}/profil/riwayat', 'MemberController@riwayat');
Route::get('/member/{id_member?}/profil/saldo', 'MemberController@saldo');
Route::get('/member/{id_member?}/profil/favorit', 'MemberController@favorit');
Route::get('/member/{id_member?}/profil/ulasan', 'MemberController@ulasan');
Route::get('/member/{id_member?}/profil/ulas', 'MemberController@ulas');


// '{{ url('/member/'.$member->id_member.'/konfigurasi-pesanan') }}'


//start
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home'); 


