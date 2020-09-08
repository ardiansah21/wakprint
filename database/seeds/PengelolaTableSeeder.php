<?php

use App\Atk;
use App\Pengelola_Percetakan;
use App\Produk;
use Illuminate\Database\Seeder;

class PengelolaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pengelola_Percetakan::create([
        //     'nama_lengkap' => 'pengelola',
        //     'email' => 'pengelola@wakprint.com',
        //     'password' => bcrypt(12345678),
        //     'nomor_hp' => '082208220822',
        //     'nama_bank' => 'BRI',
        //     'nomor_rekening' => '0000000000000',
        //     'nama_toko' => 'INI Toko',
        //     'alamat_toko' => json_encode('{
        //         "desa":"Halaban",
        //         "kecamatan":"Besitang",
        //         "kabupaten":"Langkat",
        //     }'),
        //     'url_google_maps' => 'belum ada',
        //     'status_toko' => 'Buka',
        //     //'rating_toko' =>4.0,
        // ]);

        $pengelola = factory(Pengelola_Percetakan::class, 3)->create()->each(function ($pengelola) {
            $pengelola->products()->createMany(factory(Produk::class, 5)->make()->toArray());
            $pengelola->atk()->createMany(factory(Atk::class, 5)->make()->toArray());
        });
    }
}
