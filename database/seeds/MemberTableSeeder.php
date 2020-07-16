<?php

use App\Member;
use Illuminate\Database\Seeder;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'nama_lengkap' => 'member',
            'email' => 'member1@wakprint.com',
            'password' => bcrypt(12345678),
            'nomor_hp' => '082210988781'
        ]);
    }
}
