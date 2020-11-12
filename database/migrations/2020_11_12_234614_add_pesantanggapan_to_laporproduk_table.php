<?php

// class AddPesantanggapanToLaporprodukTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::table('lapor_produk', function (Blueprint $table) {
//             $table->dropColumn('waktu');
//             $table->text('pesan_tanggapan')->nullable()->after('pesan');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::table('lapor_produk', function (Blueprint $table) {
//             $table->timestamp('waktu');
//             $table->dropColumn('pesan_tanggapan');
//         });
//     }
// }
