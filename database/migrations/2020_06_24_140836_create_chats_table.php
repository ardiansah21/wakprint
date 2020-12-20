<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id_chat');
            $table->integer('id_pesanan')->unsigned(); $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan');
            $table->integer('id_member')->unsigned(); $table->foreign('id_member')->references('id_member')->on('member');
            $table->integer('id_pengelola')->unsigned(); $table->foreign('id_pengelola')->references('id_pengelola')->on('pengelola_percetakan');
            $table->enum('from_user', ['member', 'partner'])->nullable();
            $table->text('pesan');
            $table->dateTime('read_at')->nullable();
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
        Schema::dropIfExists('chat');
    }
}
