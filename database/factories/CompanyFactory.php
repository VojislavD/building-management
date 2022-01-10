<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status' => collect([Company::STATUS_ACTIVE, Company::STATUS_INACTIVE])->random()
        ];
    }

    public function active(): Factory
    {
        return $this->state([
            'status' => Company::STATUS_ACTIVE
        ]);
    }

    public function inactive(): Factory
    {
        return $this->state([
            'status' => Company::STATUS_INACTIVE
        ]);
    }
}
