<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Member extends Authenticable implements HasMedia, MustVerifyEmail
{
    use Notifiable, HasMediaTrait;

    protected $table = "member";

    // protected $guard = 'member';
    protected $primaryKey = 'id_member';

    protected $guarded = [];
    // protected $guarded = ['id_member', 'created_at', 'updated_at'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'alamat' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function konfigurasi()
    {
        return $this->hasMany('App\Konfigurasi_file', 'id_member');
    }

    public static function cekProdukFavorit($idMember, $idProduk): bool
    {
        $produkFavorit = Member::find($idMember)->produk_favorit;

        return in_array($idProduk, json_decode($produkFavorit));
    }

    // public function pesanans()
    // {
    //     return $this->hasMany(Pesanan::class, 'id_member');
    // }

    public function messages()
    {
        return $this->hasMany('App\Message', 'id_member');
    }

    public function transaksiSaldo()
    {
        return $this->hasMany('App\Transaksi_saldo', 'id_member');
    }

    public function pesanans()
    {
        return $this->hasMany('App\Pesanan', 'id_member');
    }

    public function ulasans()
    {
        return $this->hasMany('App\Ulasan', 'id_member');
    }
}
