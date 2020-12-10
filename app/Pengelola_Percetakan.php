<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Pengelola_Percetakan extends Authenticable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    protected $table = "pengelola_percetakan";
    protected $primaryKey = 'id_pengelola';

    //set nilai kolom db default
    protected $attributes = [
        'rating_toko' => 5.0,
        'status_toko' => 'Buka',
        'ntkwh' => 0,
    ];
    //  protected $guard = 'partner';
    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    /**
     * Get all of the user's images.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function products()
    {
        return $this->hasMany('App\Produk', 'id_pengelola');
    }

    public function atk()
    {
        return $this->hasMany('App\Atk', 'id_pengelola');
    }

    //TODO diganti dengan yang ada s nya di cek lagi mana aja yang tidak menggunakan s
    public function pesanan()
    {
        return $this->hasMany('App\Pesanan', 'id_pengelola');
    }
    public function pesanans()
    {
        return $this->hasMany('App\Pesanan', 'id_pengelola');
    }

    public function transaksiSaldo()
    {
        return $this->hasMany('App\Transaksi_saldo', 'id_transaksi');
    }

    // public function hapus()
    // {

    //     // $this->atk()->delete();
    //     // $this->products()->delete();
    //     return parent::delete();
    // }

    // // this is a recommended way to declare event handlers
    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($partner) { // before delete() method call this
    //         $partner->atk()->delete();
    //         $partner->products()->delete();
    //         // do the rest of the cleanup...
    //     });
    // }
}
