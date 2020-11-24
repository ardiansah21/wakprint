<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Pengelola_Percetakan extends Authenticable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    protected $table = "pengelola_percetakan";
    protected $primaryKey = 'id_pengelola';

    //set nilai kolom db default
    protected $attributes = [
        'rating_toko' => 5.0,
        'status_toko' => 'Buka',
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
    // public function media()
    // {
    //     return $this->morphMany(Media::class, 'model');
    // }

    public function products()
    {
        return $this->hasMany('App\Produk', 'id_pengelola');
    }

    public function atk()
    {
        return $this->hasMany('App\Atk', 'id_pengelola');
    }

    public function pesanan()
    {
        return $this->hasMany('App\Pesanan', 'id_pengelola');
    }
}
