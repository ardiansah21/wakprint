<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Transaksi_saldo;

class TransaksiSaldoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Transaksi_saldo::create([
        //     'jenis_transaksi' => 'TopUp',
        //     'jumlah_saldo' => 5000,
        //     'kode_pembayaran' => '2353141',
        //     'status' => 'Pending',
        //     'keterangan' => 'Ini keterangan',
        //     'waktu' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);
        Transaksi_saldo::create([
            'jenis_transaksi' => 'Tarik',
            'jumlah_saldo' => 100000,
            'kode_pembayaran' => '775647231',
            'status' => 'Berhasil',
            'keterangan' => 'Tarik Saldo Berhasil',
            'waktu' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // Transaksi_saldo::create([
        //     'jenis_transaksi' => 'Pembayaran',
        //     'jumlah_saldo' => 10000,
        //     'kode_pembayaran' => '2667441',
        //     'status' => 'Berhasil',
        //     'keterangan' => 'Cetak Hitam Putih Dokumen',
        //     'waktu' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);
    }
}
