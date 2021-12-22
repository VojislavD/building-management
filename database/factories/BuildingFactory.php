<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'internal_code' => $this->faker->unique()->randomNumber(5),
            'pib' => $this->faker->unique()->randomNumber(9),
            'identification_number' => $this->faker->unique()->randomNumber(9),
            'account_number' => $this->faker->randomNumber(3).'-'.$this->faker->randomNumber(5).'-'.$this->faker->randomNumber(2),
            'balance' => $this->faker->numberBetween(1000, 1000000),
            'construction_year' => $this->faker->numberBetween(1970, now()->year()),
            'square' => $this->faker->randomNumber(4),
            'floors' => $this->faker->numberBetween(1,30),
            'apartments' => $this->faker->numberBetween(4, 150),
            'tenants' => $this->faker->numberBetween(5, 300),
            'elevator' => $this->faker->boolean(80),
            'yard' => $this->faker->boolean(30),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'municipality' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'balance_begining' => $this->faker->numberBetween(1000, 10000),
            'comment' => $this->faker->text(500)
        ];
    }
}
