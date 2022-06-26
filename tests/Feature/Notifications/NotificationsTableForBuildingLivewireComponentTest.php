<?php

namespace Tests\Feature\Notifications;

use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationsTableForBuildingLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $building = Building::factory()->create();
        $notification = Notification::factory()->for($building)->create();

        Livewire::test('notifications.notifications-table-for-building', [
            'building' => $building,
        ])
            ->assertSee($notification->subject);
    }

    /**
     * @test
     */
    public function test_that_component_shows_correct_data_when_status_is_selected()
    {
        $building = Building::factory()->create();
        $notificationScheduled = Notification::factory()->for($building)->scheduled()->create();
        $notificationProcessing = Notification::factory()->for($building)->processing()->create();
        $notificationFinished = Notification::factory()->for($building)->finished()->create();
        $notificationCancelled = Notification::factory()->for($building)->cancelled()->create();

        Livewire::test('notifications.notifications-table-for-building', [
            'building' => $building,
        ])
            ->assertSee($notificationScheduled->subject)
            ->assertSee($notificationProcessing->subject)
            ->assertSee($notificationFinished->subject)
            ->assertSee($notificationCancelled->subject);

        Livewire::test('notifications.notifications-table-for-building', [
            'building' => $building,
        ])
            ->set('status', NotificationStatus::Scheduled())
            ->assertSee($notificationScheduled->subject)
            ->assertDontSee($notificationProcessing->subject)
            ->assertDontSee($notificationFinished->subject)
            ->assertDontSee($notificationCancelled->subject);

        Livewire::test('notifications.notifications-table-for-building', [
            'building' => $building,
        ])
            ->set('status', NotificationStatus::Processing())
            ->assertSee($notificationProcessing->subject)
            ->assertDontSee($notificationScheduled->subject)
            ->assertDontSee($notificationFinished->subject)
            ->assertDontSee($notificationCancelled->subject);

        Livewire::test('notifications.notifications-table-for-building', [
            'building' => $building,
        ])
            ->set('status', NotificationStatus::Finished())
            ->assertSee($notificationFinished->subject)
            ->assertDontSee($notificationScheduled->subject)
            ->assertDontSee($notificationProcessing->subject)
            ->assertDontSee($notificationCancelled->subject);

        Livewire::test('notifications.notifications-table-for-building', [
            'building' => $building,
        ])
            ->set('status', NotificationStatus::Cancelled())
            ->assertSee($notificationCancelled->subject)
            ->assertDontSee($notificationScheduled->subject)
            ->assertDontSee($notificationProcessing->subject)
            ->assertDontSee($notificationFinished->subject);
    }
}
