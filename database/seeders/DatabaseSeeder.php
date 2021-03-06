<?php

namespace Database\Seeders;

use App\Models\outlet;
use App\Models\member;
use App\Models\paket;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * menjalalankan semua perintah yang ada pada factory berdasarkan model yang telah ditentukan
     *
     * @return void
     */
    public function run()
    {
        outlet::factory(15)->create();
        member::factory(15)->create();
        paket::factory(15)->create();
        User::create([
            'name' => 'Muhamad Raihan Nugraha',
            'email' => 'mraihann@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'id_outlet' => '1',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'id_outlet' => '1',
            'role' => 'admin'
        ]);
        
        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'id_outlet' => '1',
            'role' => 'owner',
        ]);
        User::create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'id_outlet' => '1',
            'role' => 'kasir',
        ]);
    }
}
