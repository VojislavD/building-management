<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'building_id' => Building::factory(),
            'tenant_id' => Tenant::factory(),
            'tenants' => $this->faker->numberBetween(1,6),
            'number' => $this->faker->numberBetween(1,100)
        ];
    }
}
