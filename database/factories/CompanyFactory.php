<?php

namespace Database\Factories;

use App\Enums\CompanyStatus;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'status' => collect([CompanyStatus::Active(), CompanyStatus::Inactive()])->random()
        ];
    }

    public function active(): Factory
    {
        return $this->state([
            'status' => CompanyStatus::Active()
        ]);
    }

    public function inactive(): Factory
    {
        return $this->state([
            'status' => CompanyStatus::Inactive()
        ]);
    }
}
