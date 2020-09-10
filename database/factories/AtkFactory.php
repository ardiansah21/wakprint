<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Atk;
use Faker\Generator as Faker;

$factory->define(Atk::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'harga' => $faker->numberBetween(1000, 10000),
        'jumlah' => $faker->numberBetween(0, 100),
        'status' => $faker->randomElement(array('Tersedia', 'TidakTersedia')),
    ];
});
