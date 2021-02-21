<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Konfigurasi_file extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = "konfigurasi_file";
    protected $primaryKey = 'id_konfigurasi';
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file_konfigurasi')->singleFile();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_member');
    }

    public function product()
    {
        return $this->belongsTo('App\Produk', 'id_produk');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'id_pesanan');
    }
}
