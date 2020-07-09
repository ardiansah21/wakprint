<?php

use Illuminate\Support\Facades\Route;

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


// Route Member

Route::get('/index', function () {
    return view('member.homepage');
});

Route::get('/member/login', function () {
    return view('member.login_member');
});

Route::get('/member/register', function () {
    return view('member.register_member');
});

Route::get('/member/profil', function () {
    return view('member.profil_member');
});

Route::get('/member/profil/edit', function () {
    return view('member.edit_profil_member');
});

Route::get('/member/pesanan/', function () {
    return view('member.pesanan_member');
});

Route::get('/member/riwayat', function () {
    return view('member.riwayat_member');
});

Route::get('/member/saldo', function () {
    return view('member.saldo_member');
});

Route::get('/member/favorit', function () {
    return view('member.produk_favorit_member');
});

Route::get('/member/ulasan', function () {
    return view('member.ulasan_member');
});

Route::get('/member/ulas', function () {
    return view('member.ulas_produk_member');
});

Route::get('/member/ulasan-saya', function () {
    return view('member.ulasan_saya_member');
});

Route::get('/member/laporkan-produk', function () {
    return view('member.lapor_produk_member');
});

Route::get('/member/alamat', function () {
    return view('member.alamat_member');
});

Route::get('/member/alamat/tambah', function () {
    return view('member.tambah_alamat_member');
});

Route::get('/member/ulasan-produk', function () {
    return view('member.ulasan_produk_pengelola');
});

Route::get('/member/faq', function () {
    return view('member.faq_member');
});

Route::get('/member/pencarian', function () {
    return view('member.pencarian_member');
});

Route::get('/member/konfirmasi-pembayaran', function () {
    return view('member.konfirmasi_pembayaran_member');
});

Route::get('/member/menunggu-pembayaran', function () {
    return view('member.menunggu_pembayaran_member');
});

Route::get('/member/detail/tempat-percetakan', function () {
    return view('member.detail_percetakan_member');
});

Route::get('/member/detail/produk', function () {
    return view('member.detail_produk_member');
});

Route::get('/member/konfigurasi-pesanan', function () {
    return view('member.konfigurasi_pesanan_member');
});

Route::get('/member/konfigurasi-file', function () {
    return view('member.konfigurasi_file_member');
});

Route::get('/member/konfigurasi-file/lanjutan', function () {
    return view('member.konfigurasi_file_lanjutan_member');
});

Route::get('/member/chat', function () {
    return view('member.chat_member');
});


// Route Pengelola

Route::get('/pengelola/login', function () {
    return view('pengelola.login_pengelola');
});

Route::get('/pengelola/register', function () {
    return view('pengelola.register_pengelola');
});

Route::get('/pengelola', function () {
    return view('pengelola.homepage_pengelola');
});

Route::get('/pengelola/pesanan', function () {
    return view('pengelola.pesanan_pengelola');
});

Route::get('/pengelola/saldo', function () {
    return view('pengelola.saldo_pengelola');
});

Route::get('/pengelola/kelola-produk', function () {
    return view('pengelola.produk_pengelola');
});

Route::get('/pengelola/kelola-promo', function () {
    return view('pengelola.promo_pengelola');
});

Route::get('/pengelola/kelola-atk', function () {
    return view('pengelola.atk_pengelola');
});

Route::get('/pengelola/info-bantuan', function () {
    return view('pengelola.info_bantuan_pengelola');
});

Route::get('/pengelola/profil', function () {
    return view('pengelola.profil_pengelola');
});

Route::get('/pengelola/pesanan-masuk/detail', function () {
    return view('pengelola.detail_pesanan_masuk_pengelola');
});

Route::get('/pengelola/transaksi/detail', function () {
    return view('pengelola.detail_transaksi_pengelola');
});

Route::get('/pengelola/saldo/tarik', function () {
    return view('pengelola.tarik_saldo_pengelola');
});

Route::get('/pengelola/promo/tambah', function () {
    return view('pengelola.tambah_promo_pengelola');
});

Route::get('/pengelola/profil/edit', function () {
    return view('pengelola.edit_profil_pengelola');
});

Route::get('/pengelola/produk/tambah', function () {
    return view('pengelola.tambah_produk_pengelola');
});

Route::get('/pengelola/atk/tambah', function () {
    return view('pengelola.tambah_atk_pengelola');
});

Route::get('/pengelola/tingkat-akurasi-warna', function () {
    return view('pengelola.tingkat_akurasi_pengelola');
});

Route::get('/pengelola/chat', function () {
    return view('pengelola.chat_pengelola');
});



// Route Admin

Route::get('/admin/login', function () {
    return view('admin.login_admin');
});

Route::get('/admin', function () {
    return view('admin.homepage_admin');
});

Route::get('/admin/data-member', function () {
    return view('admin.data_member_admin');
});

Route::get('/admin/data-pengelola', function () {
    return view('admin.data_pengelola_admin');
});

Route::get('/admin/konfirmasi-saldo', function () {
    return view('admin.konfirmasi_saldo_admin');
});

Route::get('/admin/keluhan', function () {
    return view('admin.kelola_keluhan_admin');
});

Route::get('/admin/tanggapi-keluhan', function () {
    return view('admin.tanggapi_keluhan_admin');
});

Route::get('/admin/data-member/detail', function () {
    return view('admin.detail_member_admin');
});

Route::get('/admin/data-pengelola/detail', function () {
    return view('admin.detail_pengelola_admin');
});

Route::get('/admin/tolak-pengelola', function () {
    return view('admin.tolak_pengelola_admin');
});