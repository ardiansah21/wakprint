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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('member', 'MemberController@profil');

//tessjson
Route::get('/testjson', 'ProductController@index');
Route::get('/testjson/tambah', 'ProductController@tambah');
Route::post('/testjson/store','ProductController@store');



