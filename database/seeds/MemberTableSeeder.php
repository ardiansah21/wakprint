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
        // Member::create([
        //     'nama_lengkap' => 'member',
        //     'email' => 'member@wakprint.com',
        //     'password' => bcrypt(12345678),
        //     'nomor_hp' => '082210988781'
        // ]);
        // Member::create([
        //     'nama_lengkap' => 'member1',
        //     'email' => 'member1@wakprint.com',
        //     'password' => bcrypt(12345678),
        //     'nomor_hp' => '082210988781'
        // ]);
        // Member::create([
        //     'nama_lengkap' => 'member2',
        //     'email' => 'member2@wakprint.com',
        //     'password' => bcrypt(12345678),
        //     'nomor_hp' => '082210988781'
        // ]);
        // Member::create([
        //     'nama_lengkap' => 'member3',
        //     'email' => 'member3@wakprint.com',
        //     'password' => bcrypt(12345678),
        //     'nomor_hp' => '082210988781'
        // ]);
        // Member::create([
        //     'nama_lengkap' => 'member4',
        //     'email' => 'member4@wakprint.com',
        //     'password' => bcrypt(12345678),
        //     'nomor_hp' => '082210988781'
        // ]);
        Member::create([
            'nama_lengkap' => 'member5',
            'email' => 'member5@wakprint.com',
            'password' => bcrypt(12345678),
            'nomor_hp' => '082210988781'
        ]);
        Member::create([
            'nama_lengkap' => 'member6',
            'email' => 'member6@wakprint.com',
            'password' => bcrypt(12345678),
            'nomor_hp' => '082210988781'
        ]);
        Member::create([
            'nama_lengkap' => 'member7',
            'email' => 'member7@wakprint.com',
            'password' => bcrypt(12345678),
            'nomor_hp' => '082210988781'
        ]);
        Member::create([
            'nama_lengkap' => 'member8',
            'email' => 'member8@wakprint.com',
            'password' => bcrypt(12345678),
            'nomor_hp' => '082210988781'
        ]);
    }
}
