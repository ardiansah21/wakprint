<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdpesananToKonfigurasifileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konfigurasi_file', function (Blueprint $table) {
            $table->integer('id_pesanan')->unsigned()->nullable(); $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
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
            $table->dropColumn('id_pesanan');
        });
    }
}
