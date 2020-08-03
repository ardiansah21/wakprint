<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PengelolaTableSeeder::class);
        $this->call(MemberTableSeeder::class);
        $this->call(TransaksiSaldoTableSeeder::class);
        $this->call(AdminTableSeeder::class);

    }
}
