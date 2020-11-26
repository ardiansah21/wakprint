<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Ulasan extends Model implements HasMedia
{
    use Notifiable, HasMediaTrait;

    protected $table = "ulasan";
    protected $primaryKey = 'id_ulasan';
    protected $guarded = [];
    //set nilai kolom db default
    protected $attributes = [
        'rating' => 5.0,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('foto_ulasan');
    }

    /**
     * Get all of the user's images.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk', 'id_produk');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'id_member');
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_member');
    }
}
