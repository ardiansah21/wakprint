<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_saldo extends Model
{
    protected $table = "transaksi_saldo";
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_member','id_pesanan','id_pengelola','jenis_transaksi','jumlah_saldo','kode_pembayaran','status','keterangan','waktu'];
    // protected $attributes = [
    //     'waktu' => Carbon::now()
    // ];
}
