<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Produk extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = "produk";
    protected $primaryKey = 'id_produk';

    //set nilai kolom db default
    protected $attributes = [
        'rating' => 5.0,
        'harga_hitam_putih' => 0,
        'harga_timbal_balik_hitam_putih' => 0,
        'harga_berwarna' => 0,
        'harga_timbal_balik_berwarna' => 0
    ];

    protected $guarded = [];

    // public function fotoProduk()
    // {
    //     return $this->hasMany(Media::class, 'model_id', 'foto_produk');
    // }

    // public function getFotoProdukUrlAttribute()
    // {
    //     return $this->fotoProduk->getUrl('foto_produk');
    // }

    /**
     * Get all of the user's images.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function partner(){
        return $this->belongsTo('App\Pengelola_Percetakan','id_pengelola');
        // return $this->belongsTo(Pengelola_Percetakan::all());
    }
}
