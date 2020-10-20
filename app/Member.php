<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Member extends Authenticable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    protected $table = "member";

    // protected $guard = 'member';
    protected $primaryKey = 'id_member';

    protected $guarded = [];
    // protected $guarded = ['id_member', 'created_at', 'updated_at'];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'alamat' => 'array'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    // public function getProdukFavoritAttribute($value)
    // {
    //     return json_decode($value);
    // }

    // public function setProdukFavoritAttribute($value)
    // {
    //     $produkFavorit = json_decode($this->attributes['produk_favorit']);

    //     foreach ($produkFavorit as $key => $pf) {
    //         if($pf == $value){
    //             array_splice($produkFavorit,$key);
    //         }
    //         else {
    //             array_push($produkFavorit,$value);
    //         }
    //     }

    //     // dd($produkFavorit);
    //     $this->attributes['produk_favorit'] = $produkFavorit;

    // }

    public static function cekProdukFavorit($idMember, $idProduk) : bool
    {
        $produkFavorit = Member::find($idMember)->produk_favorit;

        return in_array($idProduk, json_decode($produkFavorit));
    }
}
