<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapor_produk', function (Blueprint $table) {
            $table->increments('id_lapor');
            $table->integer('id_produk')->unsigned(); $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->integer('id_member')->unsigned(); $table->foreign('id_member')->references('id_member')->on('member');
            $table->text('pesan');
            $table->text('pesan_tanggapan')->nullable();
            $table->enum('status', ['Ditanggapi', 'Pending'])->nullable();
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
        Schema::dropIfExists('lapor_produk');
    }
}
