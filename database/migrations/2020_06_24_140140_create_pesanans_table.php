<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->increments('id_pesanan');
            $table->integer('id_atk')->unsigned()->nullable(); $table->foreign('id_atk')->references('id_atk')->on('atk');
            $table->integer('id_member')->unsigned(); $table->foreign('id_member')->references('id_member')->on('member');
            $table->integer('id_pengelola')->unsigned(); $table->foreign('id_pengelola')->references('id_pengelola')->on('pengelola_percetakan');
            $table->json('file_konfigurasi')->nullable();
            $table->json('atk_terpilih')->nullable();
            $table->enum('metode_penerimaan', ['Ditempat', 'Diantar']);
            $table->string('alamat_penerima')->nullable();
            $table->integer('ongkos_kirim')->nullable();
            $table->integer('biaya');
            $table->enum('status', ['Batal', 'Pending', 'Diproses', 'Selesai'])->nullable();
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
        Schema::dropIfExists('pesanan');
    }
}
