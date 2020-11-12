<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = "pesanan";
    protected $primaryKey = 'id_pesanan';
    protected $guarded = [];

    public function konfigurasiFile()
    {
        return $this->hasMany('App\Konfigurasi_file','id_konfigurasi');
    }
}
