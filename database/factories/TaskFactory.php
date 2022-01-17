<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status' => collect([Task::STATUS_PENDING, Task::STATUS_COMPLETED, Task::STATUS_CANCELLED])->random(),
            'description' => $this->faker->realText(1000)
        ];
    }

    public function pending(): Factory
    {
        return $this->state([
            'status' => Task::STATUS_PENDING
        ]);
    }

    public function completed(): Factory
    {
        return $this->state([
            'status' => Task::STATUS_COMPLETED
        ]);
    }

    public function cancelled(): Factory
    {
        return $this->state([
            'status' => Task::STATUS_CANCELLED
        ]);
    }
}
