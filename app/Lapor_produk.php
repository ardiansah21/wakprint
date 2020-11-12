<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lapor_produk extends Model
{
    protected $table = "lapor_produk";
    protected $primaryKey = 'id_lapor';
    protected $fillable = ['id_produk', 'id_member', 'pesan', 'pesan_tanggapan', 'waktu', 'status'];

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_member');
        // return $this->belongsTo(Pengelola_Percetakan::all());
    }
}
