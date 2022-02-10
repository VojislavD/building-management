<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Building;
use App\Models\Task;
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
                TaskStatus::Pending->value, 
                TaskStatus::Completed->value, 
                TaskStatus::Cancelled->value
            ])->random(),
            'description' => $this->faker->realText(1000)
        ];
    }

    public function pending(): Factory
    {
        return $this->state([
            'status' => TaskStatus::Pending->value
        ]);
    }

    public function completed(): Factory
    {
        return $this->state([
            'status' => TaskStatus::Completed->value
        ]);
    }

    public function cancelled(): Factory
    {
        return $this->state([
            'status' => TaskStatus::Cancelled->value
        ]);
    }
}
