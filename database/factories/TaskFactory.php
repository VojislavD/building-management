<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Building;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'user_id' => User::factory(),
            'status' => collect([
                TaskStatus::Pending(),
                TaskStatus::Completed(),
                TaskStatus::Cancelled(),
            ])->random(),
            'description' => $this->faker->realText(1000),
        ];
    }

    public function pending(): Factory
    {
        return $this->state([
            'status' => TaskStatus::Pending(),
        ]);
    }

    public function completed(): Factory
    {
        return $this->state([
            'status' => TaskStatus::Completed(),
        ]);
    }

    public function cancelled(): Factory
    {
        return $this->state([
            'status' => TaskStatus::Cancelled(),
        ]);
    }
}
