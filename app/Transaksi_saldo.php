<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_saldo extends Model
{
    protected $table = "transaksi_saldo";
    protected $primaryKey = 'id_transaksi';
    protected $guarded = [];

    public function partner()
    {
        return $this->belongsTo('App\Pengelola_Percetakan', 'id_pengelola');
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_member');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'id_pesanan');
    }
}
