<?php

use App\Member;
use App\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\StoreProductRequest;
use App\Http\Controllers\MemberController;
use Illuminate\Notifications\Notification;
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

Auth::routes(['verify' => true]);
Route::post('/upload-pdf', 'MemberController@uploadPdf')->name('upload.pdf');
Route::post('/uploaddd', 'MemberController@uploadtes')->name('upload.test');
Route::get('/member', 'MemberController@member');

// temp dropzone
Route::post('/users/fileupload/', 'MemberController@fileupload')->name('users.fileupload');

Route::get('produk', 'MemberController@produk')->name('produk');
Route::any('pencarian', 'MemberController@pencarian')->name('pencarian');
Route::get('pencariantes', 'MemberController@pencarianTes')->name('pencariantes');
Route::get('partner/detail/{id}', 'MemberController@detailPartner')->name('detail.partner');
Route::get('produk/detail/{id}', 'MemberController@detailProduk')->name('detail.produk');
Route::get('produk/detail/share', 'MemberController@shareLink')->name('detail.produk.share');
Route::get('ulasan/partner/{id}', 'MemberController@ulasanPartner')->name('ulasan.partner');
Route::get('faq', 'MemberController@faq')->name('faq');
Route::get('tentang', 'MemberController@tentang')->name('tentang');

//member
Route::get('/', 'MemberController@index')->name('home');

Route::get('pencarian/cari', 'MemberController@cari')->name('cari');
Route::get('ulasan/partner/urutkan/{id}', 'MemberController@urutkanProdukPartner')->name('urutkan.ulasan-produk.partner');
Route::middleware('auth')->group(function () {
    Route::post('/konfigurasi/upload', 'MemberController@upload')->name('upload.file.home');
    Route::get('/profil', 'MemberController@profile')->name('profile');
    Route::get('profil/edit', 'MemberController@profileEdit')->name('profile.edit');
    Route::post('/profil/edit', 'MemberController@updateDataProfile');
    Route::get('profil/alamat', 'MemberController@alamat')->name('alamat');
    Route::post('profil/alamat/update/{id}', 'MemberController@editAlamat')->name('alamat.edit');
    Route::post('profil/alamat/tambah/{id}', 'MemberController@tambahAlamat')->name('alamat.tambah');
    Route::get('profil/alamat/hapus/{id}', 'MemberController@hapusAlamat')->name('alamat.hapus');
    Route::get('profil/alamat/pilih/{id}', 'MemberController@pilihAlamat')->name('alamat.pilih');
    Route::get('saldo', 'MemberController@saldo')->name('saldo');
    Route::post('saldo/topup', 'MemberController@topUpSaldo')->name('saldo.topup');
    Route::get('saldo/topup/batal/{id}', 'MemberController@batalTopUpSaldo')->name('saldo.topup.batal');
    Route::get('saldo/pembayaran/{id}', 'MemberController@saldoPembayaran')->name('saldo.pembayaran');
    Route::get('saldo/riwayat/{id}', 'MemberController@riwayatSaldo')->name('riwayat.saldo');
    Route::get('riwayat', 'MemberController@riwayat')->name('riwayat');
    Route::get('riwayat/filter', 'MemberController@filterRiwayat')->name('riwayat.filter');
    Route::get('pesanan', 'MemberController@pesanan')->name('pesanan');
    Route::get('pesanan/detail', 'MemberController@detailPesanan')->name('pesanan.detail');
    Route::get('favorit', 'MemberController@favorit')->name('favorit');
    Route::post('favorit/status/{id}', 'MemberController@tambahFavorit')->name('favorit.status');
    Route::get('ulasan', 'MemberController@ulasan')->name('ulasan');
    Route::get('ulasan/urutkan', 'MemberController@filterUlasan')->name('urutkan.ulasan');
    Route::get('/ulasan/ulas/{idProduk}/{idPesanan}', 'MemberController@ulas')->name('ulasan.ulas');
    Route::get('/ulasan/ulasan-saya/{idProduk}/{idUlasan}', 'MemberController@ulasanSaya')->name('ulasan.ulasansaya');
    Route::post('ulasan/ulasan-saya/{idProduk}', 'MemberController@storeUlasan')->name('ulasan.store');
    Route::get('produk/lapor/{id}', 'MemberController@laporProduk')->name('produk.lapor');
    Route::post('produk/lapor/store/{id}', 'MemberController@storeLapor')->name('lapor.store');
    Route::any('/konfigurasi-file', 'KonfigurasiController@konfigurasiFile')->name('konfigurasi.file');
    Route::post('/konfigurasi-file/upload', 'KonfigurasiController@uploadFile')->name('konfigurasi.upload');
    Route::get('/konfigurasi-file/produk/{produkId}', 'KonfigurasiController@selectedProduk')->name('konfigurasi.produk');
    Route::get('/konfigurasi-file/cekwarna', 'KonfigurasiController@prosesCekWarna')->name('konfigurasi.cekwarna');
    Route::post('/konfigurasi-file/tambah', 'KonfigurasiController@tambahKonfigurasi')->name('konfigurasi.tambah');
    Route::post('/konfigurasi-file/simpan', 'KonfigurasiController@simpanKonfigurasi')->name('konfigurasi.simpan');
    Route::get('/konfigurasi-file/edit/{id}', 'KonfigurasiController@editKonfigurasi')->name('konfigurasi.edit');
    Route::post('/konfigurasi-file/edit/store/{id}', 'KonfigurasiController@storeEditKonfigurasi')->name('konfigurasi.edit.store');
    Route::delete('/konfigurasi-file/delete/{id}', 'KonfigurasiController@hapusKonfigurasi')->name('konfigurasi.hapus');
    Route::get('/konfigurasi-file/halaman-kustom', 'KonfigurasiController@kustomHal')->name('halaman.kustom');
    Route::get('/konfigurasi-pesanan', 'KonfigurasiController@konfigurasiPesanan')->name('konfigurasi.pesanan');
    Route::get('/konfigurasi-pesanan/konfirmasi', 'KonfigurasiController@konfirmasiPesanan')->name('konfirmasi.pesanan');
    Route::post('/konfigurasi-pesanan/create', 'KonfigurasiController@createPesanan')->name('konfigurasi.pesanan.create');
    Route::get('/konfirmasi-pembayaran/{idPesanan}', 'KonfigurasiController@konfirmasiPembayaran')->name('konfirmasi.pembayaran');
    Route::post('/konfirmasi-pembayaran/update/{idPesanan}', 'KonfigurasiController@updateKonfirmasiPesanan')->name('konfirmasi.pesanan.update');
    Route::get('/konfirmasi-pembayaran/delete/{idPesanan}', 'KonfigurasiController@deleteKonfirmasiPesanan')->name('konfirmasi.pesanan.delete');
    Route::get('/konfirmasi-pembayaran/cancel/{idPesanan}', 'KonfigurasiController@cancelPesanan')->name('konfirmasi.pesanan.cancel');
    Route::get('/konfirmasi-pembayaran/selesai/{idPesanan}', 'KonfigurasiController@selesaikanPesanan')->name('konfirmasi.pesanan.selesai');

    //tes notifikasi
    Route::get('/tesnotif', 'MemberController@notif');

});

//Pengelola percetakan
Route::namespace ('Partner')->prefix('partner')->name('partner.')->group(function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('register', 'Auth\RegisterController@showRegisterPage')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

//partner Password Reset routes
    Route::post('/password/email', 'Auth\PartnerForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'Auth\PartnerResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset', 'Auth\PartnerForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('/password/reset/{token}', 'Auth\PartnerResetPasswordController@showResetForm')->name('password.reset');
    Route::get('pengujian', 'PartnerController@pengujianDeteksiWarna')->name('pengujian');

    Route::middleware('auth:partner')->group(function () {
        Route::get('/', 'PartnerController@index')->name('home');
        Route::get('profil', 'PartnerController@profile')->name('profile');
        Route::get('profil/edit', 'PartnerController@profileEdit')->name('profile.edit');
        Route::post('profil/edit', 'PartnerController@profileUpdate');
        Route::post('profil/media', 'PartnerController@storeMedia')->name('profile.storeMedia');
        Route::get('saldo', 'PartnerController@saldo')->name('saldo');
        Route::get('saldo/filter', 'PartnerController@filterSaldo')->name('saldo.filter');
        Route::get('saldo/tarik', 'PartnerController@tarikSaldo')->name('saldo.tarik');
        Route::post('saldo/tarik/store', 'PartnerController@storeTarikSaldo')->name('saldo.tarik.store');
        Route::get('saldo/export_excel', 'PartnerController@exportTransaksiSaldo')->name('saldo.export');
        Route::resource('produk', 'ProdukController');
        Route::post('produk/media', 'ProdukController@storeMedia')->name('produk.storeMedia');
        Route::get('produk/duplicate/{id}', 'ProdukController@duplicate')->name('produk.duplicate');
        Route::get('pesanan', 'PesananController@index')->name('pesanan');
        Route::get('pesanan/filter', 'PesananController@filterPesanan')->name('pesanan.filter');
        Route::get('pesanan/detail/{id}', 'PesananController@detailPesanan')->name('detail.pesanan');
        Route::get('pesanan/detail/terima/{id}', 'PesananController@terimaPesanan')->name('detail.pesanan.terima');
        Route::get('pesanan/detail/tolak/{id}', 'PesananController@tolakPesanan')->name('detail.pesanan.tolak');
        Route::get('pesanan/detail/selesai/{id}', 'PesananController@selesaikanPesanan')->name('detail.pesanan.selesai');
        Route::get('riwayat/{id}', 'PartnerController@riwayatTransaksi')->name('riwayat.saldo');
        Route::get('promo/create/search', 'PromoController@search')->name('promo.search');
        Route::resource('promo', 'PromoController');
        Route::post('promo/store/create', 'PromoController@storeCreate')->name('promo.store.create');
        Route::post('promo/store/update/{id}', 'PromoController@update')->name('promo.store.update');
        Route::resource('atk', 'AtkController');
        Route::get('info', 'PartnerController@info')->name('info');
        Route::post('ubah-status', 'PartnerController@statusToko')->name('ubah-status');
        Route::post('filter/riwayat', 'PartnerController@filterSaldo')->name('filter.riwayat');
        Route::post('search/produk', 'PromoController@searchProdukPartner')->name('search.produk');

        //tes notif partner
        Route::get('/tesnotifpartner', 'PartnerController@notif');
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
        Route::get('/partner/tolak/tanggapi/{id}', 'AdminController@alasanTolakPartner')->name('partner.tolak.tanggapi');
        Route::get('partner/detail/{id}', 'AdminController@detailPartner')->name('partner.detail');
        Route::post('partner/terima/{id}', 'AdminController@terimaPartner')->name('partner.terima');
        Route::get('/saldo', 'AdminController@dataSaldo')->name('saldo');
        Route::get('saldo/tolak/{id}', 'AdminController@saldoTolak')->name('saldo.tolak');
        Route::post('saldo/tolak/saldo/store/{id}', 'AdminController@storeTolak')->name('saldo.tolak.store');
        Route::get('saldo/terima/saldo-member/store/{id}', 'AdminController@storeTerimaSaldoMember')->name('saldo.terima.saldo-member.store');
        Route::get('saldo/terima/saldo-partner/store/{id}', 'AdminController@storeTerimaSaldoPartner')->name('saldo.terima.saldo-partner.store');
        Route::get('/keluhan', 'AdminController@keluhan')->name('keluhan');
        Route::get('keluhan/detail/{id}', 'AdminController@detailKeluhan')->name('detail.keluhan');
        Route::post('keluhan/tanggapi', 'AdminController@tanggapiKeluhan')->name('keluhan.tanggapi');
        Route::get('member/json', 'AdminController@memberJson')->name('member.json');
        Route::get('partner/json', 'AdminController@partnerJson')->name('partner.json');
        Route::get('saldo/member/json', 'AdminController@saldoMemberJson')->name('saldo.member.json');
        Route::get('saldo/partner/json', 'AdminController@saldoPartnerJson')->name('saldo.partner.json');
        Route::get('keluhan/json', 'AdminController@keluhanJson')->name('keluhan.json');
    });
});

//chat
Route::get('/partner/chat', 'ChatController@indexPartner')->middleware('auth:partner')->name('partner.chat');
Route::group(['prefix' => 'chat'], function () {
    Route::get('/', 'ChatController@index')->middleware('auth')->name('chat');
    Route::get('pesanan', 'ChatController@pesanan');
    Route::get('message/{id}', 'ChatController@message');
    Route::get('message/{id}/read', 'ChatController@read');
    Route::post('message', 'ChatController@send');
});

//TEMP
Route::resource('pdf', 'PdfController');

Route::post('store2', 'PdfController@store2')->name('store2');

//PENGUJIAN
Route::get('pengujian', 'PengujianController@index')->name('pengujian');
Route::post('pengujian/store', 'PengujianController@store')->name('pengujian.store');
Route::post('pengujian/proses', 'PengujianController@proses')->name('pengujian.proses');

//Testing seasion
Route::get('session', 'SessionController@index');
Route::get('session/put', 'SessionController@put');
Route::get('session/push', 'SessionController@push');
Route::get('session/del', 'SessionController@delete');
Route::get('session/tes', 'SessionController@tes');

//Notifikasi
Route::prefix('/notif')->group(function () {
    Route::get('/', 'NotificationController@index');
    Route::post('read', 'NotificationController@read');
    Route::get('read-all', 'NotificationController@readAll');
});
