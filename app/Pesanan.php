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
        return $this->hasMany('App\Konfigurasi_file', 'id_pesanan');
    }

    public function partner()
    {
        return $this->belongsTo('App\Pengelola_Percetakan', 'id_pengelola');
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_member');
    }

    public function ulasans()
    {
        return $this->hasMany('App\Ulasan', 'id_member');
    }
}
