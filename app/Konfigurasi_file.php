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
    // protected $fillable = ['id_konfigurasi','id_member','id_produk','nama_file','jumlah_halaman_berwarna','jumlah_halaman_hitamputih','halaman_terpilih','jumlah_salinan','paksa_hitamputih','biaya','catatan_tambahan','nama_produk','fitur_terpilih','waktu'];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'halaman_terpilih' => 'array',
    // ];

    //

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file_konfigurasi');
        // ->singleFile();
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
