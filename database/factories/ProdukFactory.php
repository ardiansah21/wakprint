<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produk;
use Faker\Generator as Faker;

$factory->define(Produk::class, function (Faker $faker) {
    $biayaHitamPutih = array(100, 250, 500, 750, 1000);
    return [
        'nama' => $faker->name,
        'harga_hitam_putih' => $faker->randomElement($biayaHitamPutih),
        'harga_timbal_balik_hitam_putih' => $faker->randomElement($biayaHitamPutih) / 2,
        'harga_berwarna' => $faker->randomElement($biayaHitamPutih) * 2,
        'harga_timbal_balik_berwarna' => ($faker->randomElement($biayaHitamPutih) * 2) / 2,
        'berwarna' => $faker->boolean,
        'hitam_putih' => $faker->boolean,
        'deskripsi' => $faker->text(200),
        'jenis_kertas' => $faker->randomElement(array('A4HVS70gr', 'A4HVS80gr', 'A3HVS70gr', 'A3HVS80gr', 'F4HVS70gr', 'F4HVS80gr', 'LegalHVS70gr', 'LegalHVS80gr', 'LetterHVS70gr', 'LeterHVS80gr')),
        'jenis_printer' => $faker->randomElement(array('Ink Jet', 'Laser Jet')),
        'rating' => $faker->randomFloat(1, 0, 5),
    ];
});
