<?php

namespace Database\Seeders;

use App\Models\outlet;
use App\Models\User;
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
        outlet::factory(3)->create();
        User::create([
            'name' => 'Muhamad Raihan Nugraha',
            'email' => 'mraihann@gmail.com',
            'password' => bcrypt('12345678'),
            'id_outlet' => '1',
            'role' => 'admin',
        ]);
    }
}
