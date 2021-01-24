<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'harga_timbal_balik_berwarna' => 0,
    ];

    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['selesai_waktu_diskon'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        // 'jarak',
        'foto_produk',
    ];

    /**
     * Get the
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusDiskonAttribute($value)
    {
        if ($this->selesai_waktu_diskon <= Carbon::now() || $this->mulai_waktu_diskon > Carbon::now()) {
            $this->update(['status_diskon' => "TidakTersedia"]);
            return "TidakTersedia";
        } else {
            $this->update(['status_diskon' => "Tersedia"]);
            return "Tersedia";
        }
    }

    public function getFotoProdukAttribute()
    {
        if (!empty($this->getFirstMediaUrl('foto_produk'))) {
            return $this->getMedia('foto_produk')->map(function ($media) {
                return $media->getFullUrl();
            });
            // return 'https://wakprint.com' . $this->getFirstMediaUrl('foto_produk');
        }
        return ['https://ui-avatars.com/api/?name=' . trim($this->nama, " ") . '&background=BC41BE&color=F2FF58'];
    }

    // public function fotoProduk()
    // {
    //     return $this->hasMany(Media::class, 'model_id', 'foto_produk');
    // }

    // public function getFotoProdukUrlAttribute()
    // {
    //     return $this->fotoProduk->getUrl('foto_produk');
    // }

    public function isFavoritProduct()
    {
        return in_array($this->id_produk, json_decode(Auth::user()->produk_favorit));
    }

    /**
     * Get all of the user's images.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function partner()
    {
        return $this->belongsTo('App\Pengelola_Percetakan', 'id_pengelola');
        // return $this->belongsTo(Pengelola_Percetakan::all());
    }

    public function konfigurasiFile()
    {
        // return $this->hasOne('App\Konfigurasi_file', 'id_konfigurasi');
        return $this->hasOne('App\Konfigurasi_file', 'id_produk');
        // return $this->belongsTo(Pengelola_Percetakan::all());
    }

    public function atks()
    {
        return ($this->partner)->atk;
    }

    public function ulasan()
    {
        return $this->hasMany('App\Ulasan', 'id_produk');
    }

    //simulasi jarak
    // public function getJarakAttribute()
    // {
    //     return ($this->partner)->id_pengelola * 100;
    // }
}
