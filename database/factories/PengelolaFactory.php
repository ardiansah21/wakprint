<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pengelola_Percetakan;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Pengelola_Percetakan::class, function (Faker $faker) {
    $dateOpen = Carbon::now();
    $dateOpen->hour = 8;
    $dateOpen->minute = 0;
    $dateOpen->format('H:i');

    $dateClose = Carbon::now();
    $dateClose->hour = 22;
    $dateClose->minute = 0;
    $dateClose->format('H:i');

    return [
        'nama_lengkap' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(12345678),
        'nomor_hp' => '082' . $faker->randomNumber(9, false),
        'nama_bank' => $faker->randomElement(array('BRI', 'BCA', 'BNI', 'Mandiri')),
        'nomor_rekening' => $faker->bankAccountNumber,
        'nama_toko' => $faker->name,
        'alamat_toko' => $faker->address,
        'url_google_maps' => 'https://www.google.com/maps/place/STMIK+-+STIE+Mikroskil,+Kampus+B/@3.5874834,98.6885374,17z/data=!3m1!4b1!4m5!3m4!1s0x303131b1ab666943:0x6919e73fdee6c03c!8m2!3d3.5874834!4d98.6907261',
        'status_toko' => 'Buka',
        'rating_toko' => $faker->randomFloat(1, 0, 5),
        'jam_op_buka' => $dateOpen,
        'jam_op_tutup' => $dateClose,
        'syaratkententuan' => $faker->text(255),
        'ambil_di_tempat' => $faker->boolean,
        'antar_ke_tempat' => $faker->boolean,
    ];
});
