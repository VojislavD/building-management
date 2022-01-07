<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
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
            'status' => collect([Client::STATUS_ACTIVE, Client::STATUS_INACTIVE])->random()
        ];
    }

    public function active(): Factory
    {
        return $this->state([
            'status' => Client::STATUS_ACTIVE
        ]);
    }

    public function inactive(): Factory
    {
        return $this->state([
            'status' => Client::STATUS_INACTIVE
        ]);
    }
}
