<?php

namespace Tests\Feature\Notifications;

use App\Console\Commands\SendBuildingNotifications;
use App\Enums\NotificationStatus;
use App\Jobs\SendNotification;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SendBuildingNotificationsCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_run_command_for_send_notifications()
    {
        Queue::fake();

        $notificationScheduled = Notification::factory()->scheduled()->create([
            'send_at' => now()->subDay(),
        ]);

        $notificationProcessing = Notification::factory()->processing()->create([
            'send_at' => now()->subDay(),
        ]);

        $notificationFinished = Notification::factory()->finished()->create([
            'send_at' => now()->subDay(),
        ]);

        $notificationCancelled = Notification::factory()->cancelled()->create([
            'send_at' => now()->subDay(),
        ]);

        $this->artisan(SendBuildingNotifications::class)->assertSuccessful();

        Queue::assertPushed(SendNotification::class);

        $this->assertDatabaseHas('notifications', [
            'id' => $notificationScheduled->id,
            'status' => NotificationStatus::Processing(),
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notificationProcessing->id,
            'status' => NotificationStatus::Processing(),
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notificationFinished->id,
            'status' => NotificationStatus::Finished(),
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $notificationCancelled->id,
            'status' => NotificationStatus::Cancelled(),
        ]);
    }
}
