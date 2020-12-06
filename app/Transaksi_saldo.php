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
        // return $this->belongsTo(Pengelola_Percetakan::all());
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_member');
        // return $this->belongsTo(Pengelola_Percetakan::all());
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'id_pesanan');
    }
    // protected $fillable = ['id_member','id_pesanan','id_pengelola','jenis_transaksi','jumlah_saldo','kode_pembayaran','status','keterangan','waktu'];
    // protected $attributes = [
    //     'waktu' => Carbon::now()
    // ];
}
