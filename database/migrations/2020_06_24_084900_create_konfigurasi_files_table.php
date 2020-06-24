<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonfigurasiFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfigurasi_file', function (Blueprint $table) {
            $table->increments('id_konfigurasi');
            $table->integer('id_member')->unsigned();$table->foreign('id_member')->references('id_member')->on('member');
            $table->integer('id_produk')->unsigned();$table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->string('nama_file',255);
            $table->smallInteger('jumlah_halaman_berwarna')->nullable();
            $table->smallInteger('jumlah_halaman_hitamputih')->nullable();
            $table->json('halaman_terpilih')->nullable();
            $table->smallInteger('jumlah_salinan')->default(0);
            $table->boolean('paksa_hitamputih')->default(false);
            $table->integer('biaya')->nullable();
            $table->text('catatan_tambahan')->nullable();
            $table->string('nama_produk',)->nullable();
            $table->timestamp('waktu');
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
        Schema::dropIfExists('konfigurasi_file');
    }
}
