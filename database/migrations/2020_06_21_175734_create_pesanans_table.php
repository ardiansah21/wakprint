<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->increments('id_pesanan');
            $table->integer('id_member')->unsigned();$table->foreign('id_member')->references('id_member')->on('members');
            $table->integer('id_pengelola')->unsigned();$table->foreign('id_pengelola')->references('id_pengelola')->on('pengelola__percetakans');
            $table->json('file_konfigurasi')->nullable();
            $table->enum('metode_penerimaan',['Ditempat','Diantar']);
            $table->string('alamat_penerima');
            $table->integer('ongkos_kirim');
            $table->integer('biaya');
            $table->enum('status',['Batal','Pending','Diproses','Selesai']);
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
        Schema::dropIfExists('pesanans');
    }
}
