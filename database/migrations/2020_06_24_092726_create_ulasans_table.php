<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->increments('id_ulasan');
            $table->integer('id_produk')->unsigned()->nullable(); $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->integer('id_member')->unsigned()->nullable(); $table->foreign('id_member')->references('id_member')->on('member');
            $table->decimal('rating', 1, 1);
            $table->string('pesan', 255)->nullable();
            $table->string('foto', 255)->nullable();
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
        Schema::dropIfExists('ulasan');
    }
}
