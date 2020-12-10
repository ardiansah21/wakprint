<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konfigurasi_file', function (Blueprint $table) {
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('konfigurasi_file', function (Blueprint $table) {
            $table->dropForeign(['id_pesanan']);
        });

    }
}
