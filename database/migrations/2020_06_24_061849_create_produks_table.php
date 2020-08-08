<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->integer('id_pengelola')->unsigned()->nullable(); $table->foreign('id_pengelola')->references('id_pengelola')->on('pengelola_percetakan');
            $table->string('nama', 150);
            $table->integer('harga_hitam_putih');
            $table->integer('harga_timbal_balik_hitam_putih')->nullable();
            $table->integer('harga_berwarna')->nullable();
            $table->integer('harga_timbal_balik_berwarna')->nullable();
            $table->boolean('berwarna');
            $table->boolean('hitam_putih');
            $table->text('deskripsi')->nullable();
            $table->enum('jenis_kertas', ['A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr', 'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr']);
            $table->enum('jenis_printer', ['Ink Jet', 'Laser Jet']);
            $table->decimal('rating', 2, 1);
            $table->enum('status', ['Tersedia', 'TidakTersedia'])->default('Tersedia');
            $table->json('foto_produk')->default(new Expression('(JSON_ARRAY())'))->nullable();
            $table->json('fitur')->default(new Expression('(JSON_ARRAY())'))->nullable();
            $table->enum('status_diskon', ['Tersedia', 'TidakTersedia'])->default('TidakTersedia');
            $table->float('jumlah_diskon')->nullable();
            $table->integer('maksimal_diskon')->nullable();
            $table->date('mulai_waktu_diskon')->nullable();
            $table->date('selesai_waktu_diskon')->nullable();
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
        Schema::dropIfExists('produk');
    }

}
