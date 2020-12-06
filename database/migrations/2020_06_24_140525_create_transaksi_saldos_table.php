<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_saldo', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_pesanan')->unsigned()->nullable(); $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan');
            $table->integer('id_pengelola')->unsigned()->nullable(); $table->foreign('id_pengelola')->references('id_pengelola')->on('pengelola_percetakan');
            $table->integer('id_member')->unsigned()->nullable(); $table->foreign('id_member')->references('id_member')->on('member');
            $table->enum('jenis_transaksi', ['TopUp', 'Tarik', 'Pembayaran'])->nullable();
            $table->integer('jumlah_saldo')->nullable();
            $table->string('kode_pembayaran', 20)->nullable();
            $table->enum('status', ['Gagal', 'Pending', 'Berhasil'])->nullable();
            $table->text('keterangan')->nullable();
            // $table->timestamp('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_saldo');
    }
}
