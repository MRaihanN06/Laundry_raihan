<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class MemberFactory extends Factory
{
    /**
     * mendefinisikan field mana yang datanya akan digenerete otomatis dengan laravel fakeer
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'jenis_kelamin' => $this->faker->randomElement(['L','P']),
            'tlp' => $this->faker->phoneNumber()
        ];
    }
}
