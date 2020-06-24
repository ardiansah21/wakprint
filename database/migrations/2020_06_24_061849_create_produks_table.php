<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
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
            $table->integer('id_pengelola')->unsigned();$table->foreign('id_pengelola')->references('id_pengelola')->on('pengelola_percetakan');
            $table->string('nama',150);
            $table->integer('harga');
            $table->text('deskripsi')->nullable();
            $table->enum('jenis_wana',['Berwarna','HitamPutih']);
            $table->enum('jenis_kertas',['A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr', 'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr']);
            $table->enum('jenis_printer',['InkJet','LaserJet']);
            $table->decimal('rating',1,1);
            $table->enum('status',['Tersedia','TidakTersedia'])->default('TidakTersedia');
            $table->string('foto_produk')->nullable();
            $table->json('fitur')->default(new Expression('(JSON_ARRAY())'));
            $table->enum('status_diskon',['Tersedia','TidakTersedia'])->default('TidakTersedia');
            $table->integer('maksimal_diskon')->nullable();
            $table->date('mulai_waktu_diskon')->nullable();
            $table->date('selesai_waktu diskon')->nullable();
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
