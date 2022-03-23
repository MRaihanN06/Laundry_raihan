<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OutletFactory extends Factory
{
    /**
     * mendefinisikan field mana yang datanya akan digenerete otomatis dengan laravel fakeer
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'tlp' => $this->faker->phoneNumber(),
        ];
    }
}
