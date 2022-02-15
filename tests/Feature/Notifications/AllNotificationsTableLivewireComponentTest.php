<?php

namespace Tests\Feature\Notifications;

use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AllNotificationsTableLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $notification = Notification::factory()->create();
        $notification2 = Notification::factory()->create();

        Livewire::test('notifications.all-notifications-table')
            ->assertSeeHtml([
                $notification->subject,
                $notification2->subject,
            ]);
    }

    /**
     * @test
     */
    public function test_that_component_shows_correct_data_when_status_is_selected()
    {
        $notificationScheduled = Notification::factory()->scheduled()->create();
        $notificationProcessing = Notification::factory()->processing()->create();
        $notificationFinished = Notification::factory()->finished()->create();
        $notificationCancelled = Notification::factory()->cancelled()->create();

        Livewire::test('notifications.all-notifications-table')
            ->assertSeeHtml([
                $notificationScheduled->subject,
                $notificationProcessing->subject,
                $notificationFinished->subject,
                $notificationCancelled->subject
            ]);

        Livewire::test('notifications.all-notifications-table')
            ->set('status', NotificationStatus::Scheduled->value)
            ->assertSeeHtml([
                $notificationScheduled->subject,
            ])
            ->assertDontSee([
                $notificationProcessing->subject,
                $notificationFinished->subject,
                $notificationCancelled->subject
            ]);

        Livewire::test('notifications.all-notifications-table')
            ->set('status', NotificationStatus::Processing->value)
            ->assertSeeHtml([
                $notificationProcessing->subject,
            ])
            ->assertDontSee([
                $notificationScheduled->subject,
                $notificationFinished->subject,
                $notificationCancelled->subject
            ]);

        Livewire::test('notifications.all-notifications-table')
            ->set('status', NotificationStatus::Finished->value)
            ->assertSeeHtml([
                $notificationFinished->subject,
            ])
            ->assertDontSee([
                $notificationScheduled->subject,
                $notificationProcessing->subject,
                $notificationCancelled->subject
            ]);

        Livewire::test('notifications.all-notifications-table')
            ->set('status', NotificationStatus::Cancelled->value)
            ->assertSeeHtml([
                $notificationCancelled->subject,
            ])
            ->assertDontSee([
                $notificationScheduled->subject,
                $notificationProcessing->subject,
                $notificationFinished->subject
            ]);
    }

    /**
     * @test
     */
    public function test_that_component_shows_correct_data_when_building_is_selected()
    {
        $building1 = Building::factory()->create();
        $building2 = Building::factory()->create();

        $notification1 = Notification::factory()->for($building1)->create();
        $notification2 = Notification::factory()->for($building2)->create();

        Livewire::test('notifications.all-notifications-table')
            ->assertSeeHtml([
                $notification1->subject,
                $notification2->subject,
            ]);

        Livewire::test('notifications.all-notifications-table')
            ->set('building_id', $building1->id)
            ->assertSeeHtml([
                $notification1->subject
            ])
            ->assertDontSee([
                $notification2->subject
            ]);

        Livewire::test('notifications.all-notifications-table')
            ->set('building_id', $building2->id)
            ->assertSeeHtml([
                $notification2->subject
            ])
            ->assertDontSee([
                $notification1->subject
            ]);
    }

    /**
     * @test
     */
    public function test_show_notifications_when_per_page_is_changed()
    {
        $notification1 = Notification::factory()->create([
            'created_at' => now()->subDay()
        ]);

        Notification::factory(8)->create();

        $notification2 = Notification::factory()->create();
        $notification3 = Notification::factory()->create();

        Livewire::test('notifications.all-notifications-table')
            ->assertSeeHtml([
                $notification2->subject,
                $notification3->subject,
            ])
            ->assertDontSee([
                $notification1->subject
            ]);

        Livewire::test('notifications.all-notifications-table')
            ->set('perPage', 15)
            ->assertSeeHtml([
                $notification1->subject,
                $notification2->subject,
                $notification3->subject,
            ]);
    }
}
