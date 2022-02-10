<?php

namespace Database\Factories;

use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
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
                NotificationStatus::Scheduled->value,
                NotificationStatus::Processing->value,
                NotificationStatus::Finished->value,
                NotificationStatus::Cancelled->value,
            ])->random(),
            'via_email' => $this->faker->boolean(),
            'subject' => $this->faker->sentence(),
            'body' => $this->faker->text(),
            'send_at' => now()->addMinute()
        ];
    }

    public function scheduled(): Factory
    {
        return $this->state([
            'status' => NotificationStatus::Scheduled->value
        ]);
    }

    public function processing(): Factory
    {
        return $this->state([
            'status' => NotificationStatus::Processing->value
        ]);
    }

    public function finished(): Factory
    {
        return $this->state([
            'status' => NotificationStatus::Finished->value
        ]);
    }

    public function cancelled(): Factory
    {
        return $this->state([
            'status' => NotificationStatus::Cancelled->value
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
