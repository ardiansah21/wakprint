<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // data faker indonesia
        $faker = Faker::create('id_ID');

        // membuat data dummy sebanyak 10 record
        for ($x = 1; $x <= 3; $x++) {

            // insert data dummy pegawai dengan faker
            DB::table('members')->insert([
                'nama_lengkap' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
                'jumlah_saldo' => $faker->randomDigit,
                'nomor_hp' => $faker->randomNumber($nbDigits = null, $strict = false),
                'jenis_kelamin' => $faker->randomElement($array = array('L', 'P')),
                'foto_profil' => null,
                'produk_favorit' => null,
            ]);
        }
    }
}
