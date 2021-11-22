<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create('fr_FR');
        /* return [
            'name' => 'Franck School',//catchPhrase             
            'address' => $this->faker->address(),
            'phone' => $this->faker->e164PhoneNumber(),
        ]; */
        return [
            'name' => 'Franck School',//catchPhrase             
            'address' => $faker->address(),
            'phone' => $faker->e164PhoneNumber(),
        ];
    }
}
