<?php

namespace Tests\Feature\Notifications;

use App\Enums\NotificationStatus;
use App\Jobs\SendNotification;
use App\Models\Apartment;
use App\Models\Building;
use App\Models\Notification as NotificationModel;
use App\Notifications\BuildingNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SendNotificationJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function test_job_send_notification_is_dispatched()
    {
        Queue::fake();

        $building = Building::factory()->create();
        Apartment::factory(5)->for($building)->create();

        $notification = NotificationModel::factory()->for($building)->scheduled()->create();

        SendNotification::dispatch($notification);

        Queue::assertPushed(SendNotification::class);
    }

    /**
     * @test
     *
     * @return void
     */
    public function test_send_notification_job_sends_notification()
    {
        Notification::fake();

        $building = Building::factory()->create();
        Apartment::factory(5)->for($building)->create();

        $notification = NotificationModel::factory()->for($building)->scheduled()->create();

        SendNotification::dispatch($notification);

        Notification::assertSentTo(
            [$notification->building->allTenants()],
            BuildingNotification::class
        );

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'status' => NotificationStatus::Finished()
        ]);
    }
}
