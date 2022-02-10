<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Building;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
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
            'status' => collect([
                ProjectStatus::Pending->value,
                ProjectStatus::Processing->value,
                ProjectStatus::Finished->value,
                ProjectStatus::Cancelled->value,
            ])->random(),
            'name' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(10000, 100000),
            'rates' => $this->faker->numberBetween(1,10),
            'amount_payed' => $this->faker->numberBetween(10000, 50000),
            'amount_left' => $this->faker->numberBetween(10000, 50000),
            'start_paying' => today(),
            'end_paying' => today()->addMonths(5)
        ];
    }

    public function pending(): Factory
    {
        return $this->state([
            'status' => ProjectStatus::Pending->value
        ]);
    }

    public function processing(): Factory
    {
        return $this->state([
            'status' => ProjectStatus::Processing->value
        ]);
    }

    public function finished(): Factory
    {
        return $this->state([
            'status' => ProjectStatus::Finished->value
        ]);
    }

    public function cancelled(): Factory
    {
        return $this->state([
            'status' => ProjectStatus::Cancelled->value
        ]);
    }
}
