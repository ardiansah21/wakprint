<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_blogs', function (Blueprint $table) {
            $table->increments('id_blog');
            $table->integer('id_kategori')->unsigned()->nullable();$table->foreign('id_kategori')->references('id_kategori')->on('tb_kategoris');
            $table->date('tanggal')->nullable();
            $table->string('judul',50)->nullable();
            $table->string('isi',50)->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('tb_blogs');
    }
}
