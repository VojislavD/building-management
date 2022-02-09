<?php

namespace Database\Factories;

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
                Project::STATUS_PENDING,
                Project::STATUS_PROCESSING,
                Project::STATUS_FINISHED,
                Project::STATUS_CANCELLED,
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
            'status' => Project::STATUS_PENDING
        ]);
    }

    public function processing(): Factory
    {
        return $this->state([
            'status' => Project::STATUS_PROCESSING
        ]);
    }

    public function finished(): Factory
    {
        return $this->state([
            'status' => Project::STATUS_FINISHED
        ]);
    }

    public function cancelled(): Factory
    {
        return $this->state([
            'status' => Project::STATUS_CANCELLED
        ]);
    }
}
