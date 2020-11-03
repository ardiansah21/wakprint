<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konfigurasi_file extends Model
{
    protected $table = "konfigurasi_file";
    protected $primaryKey = 'id_konfigurasi';
    protected $guarded = [];
    protected $fillable = ['id_konfigurasi','id_member','id_produk','nama_file','jumlah_halaman_berwarna','jumlah_halaman_hitamputih','halaman_terpilih','jumlah_salinan','paksa_hitamputih','biaya','catatan_tambahan','nama_produk','fitur_terpilih','waktu'];

    public function member(){
        return $this->belongsTo('App\Member','id_member');
    }
}
