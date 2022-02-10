<?php

namespace Database\Factories;

use App\Enums\BuildingStatus;
use App\Models\Building;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Building>
 */
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
            'company_id' => Company::factory(),
            'internal_code' => $this->faker->unique()->randomNumber(5, true),
            'status' => BuildingStatus::Active->value,
            'pib' => $this->faker->unique()->randomNumber(9, true),
            'identification_number' => $this->faker->unique()->randomNumber(8, true),
            'account_number' => $this->faker->randomNumber(3, true).'-'.$this->faker->randomNumber(5, true).'-'.$this->faker->randomNumber(2, true),
            'balance' => $this->faker->numberBetween(1000, 1000000),
            'construction_year' => $this->faker->numberBetween(1970, now()->year),
            'square' => $this->faker->randomNumber(4, true),
            'floors' => $this->faker->numberBetween(1,30),
            'elevator' => $this->faker->boolean(80),
            'yard' => $this->faker->boolean(30),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'county' => $this->faker->country(),
            'postal_code' => $this->faker->randomNumber(5, true),
            'balance_begining' => $this->faker->numberBetween(1000, 10000),
            'comment' => $this->faker->text(500)
        ];
    }

    public function active(): Factory
    {
        return $this->state([
            'status' => BuildingStatus::Active->value
        ]);
    }

    public function inactive(): Factory
    {
        return $this->state([
            'status' => BuildingStatus::Inactive->value
        ]);
    }
}
