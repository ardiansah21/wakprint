<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = "pesanan";
    protected $primaryKey = 'id_pesanan';
    protected $guarded = [];
    protected $appends = [
        'nama_file',
    ];

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

    public function transaksiSaldo()
    {
        return $this->hasOne('App\Transaksi_saldo', 'id_pesanan');
    }

    public static function isPaid()
    {
        return auth(activeGuard())->user()->pesanans->first()->transaksiSaldo->where('jenis_transaksi', 'Pembayaran')
            ->where('status', 'Berhasil')->exists() ? true : false;
    }
}
