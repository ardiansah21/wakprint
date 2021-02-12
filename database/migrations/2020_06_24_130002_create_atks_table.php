<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atk', function (Blueprint $table) {
            $table->increments('id_atk');
            $table->integer('id_pengelola')->unsigned(); $table->foreign('id_pengelola')->references('id_pengelola')->on('pengelola_percetakan')->onDelete('cascade');
            $table->string('nama', 150)->nullable();
            $table->integer('harga');
            $table->smallInteger('jumlah')->unsigned();
            $table->enum('status', ['Tersedia', 'TidakTersedia'])->default('TidakTersedia');
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
        Schema::dropIfExists('atk');
    }
}
