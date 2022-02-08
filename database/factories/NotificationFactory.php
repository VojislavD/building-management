<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
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
                Notification::STATUS_SCHEDULED,
                Notification::STATUS_PROCESSING,
                Notification::STATUS_FINISHED,
                Notification::STATUS_CANCELLED,
            ])->random(),
            'via_email' => $this->faker->boolean(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->text(),
            'send_at' => now()->addMinute()
        ];
    }

    public function scheduled(): Factory
    {
        return $this->state([
            'status' => Notification::STATUS_SCHEDULED
        ]);
    }

    public function processing(): Factory
    {
        return $this->state([
            'status' => Notification::STATUS_PROCESSING
        ]);
    }

    public function finished(): Factory
    {
        return $this->state([
            'status' => Notification::STATUS_FINISHED
        ]);
    }

    public function cancelled(): Factory
    {
        return $this->state([
            'status' => Notification::STATUS_CANCELLED
        ]);
    }

    public function viaEmail(): Factory
    {
        return $this->state([
            'via_email' => true
        ]);
    }

    public function notViaEmail(): Factory
    {
        return $this->state([
            'via_email' => false
        ]);
    }
}
