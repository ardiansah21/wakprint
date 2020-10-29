<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolaPercetakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('pengelola_percetakan', function (Blueprint $table) {
            $table->increments('id_pengelola');
            $table->string('nama_lengkap', 100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            // $table->string('email',320);
            // $table->string('password',100);

            $table->integer('jumlah_saldo')->nullable();
            $table->string('nomor_hp', 16);
            $table->string('nama_bank', 100);
            $table->string('nomor_rekening', 20);
            $table->string('foto_profil')->nullable();
            $table->string('nama_toko', 150);
            $table->text('deskripsi_toko')->nullable();
            $table->string('alamat_toko');
            $table->string('url_google_maps')->nullable();
            $table->enum('status_toko', ['Buka', 'Tutup']);
            $table->decimal('rating_toko', 2, 1);
            $table->timestamp('jam_op_buka')->nullable();
            $table->timestamp('jam_op_tutup')->nullable();
            $table->text('syaratkententuan')->nullable();
            $table->string('foto_toko')->nullable();
            $table->boolean('ambil_di_tempat')->nullable();
            $table->boolean('antar_ke_tempat')->nullable();
            $table->smallInteger('ntkwh')->nullable();
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
        Schema::dropIfExists('pengelola_percetakan');
    }
}
