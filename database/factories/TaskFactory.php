<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Task;
use App\Models\Tenant;
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
            'tenant_id' => Tenant::factory(),
            'status' => collect([Task::STATUS_PENDING, Task::STATUS_FINISHED, Task::STATUS_REJECTED])->random(),
            'description' => $this->faker->paragraphs(2)
        ];
    }
}
