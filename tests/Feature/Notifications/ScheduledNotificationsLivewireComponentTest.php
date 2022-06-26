<?php

namespace Tests\Feature\Notifications;

use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ScheduledNotificationsLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $notification1 = Notification::factory()->scheduled()->create([
            'created_at' => now()->subDay(),
        ]);
        Notification::factory(4)->scheduled()->create();
        $notification2 = Notification::factory()->scheduled()->create();
        $processingNotification = Notification::factory()->processing()->create();
        $finishedNotification = Notification::factory()->finished()->create();
        $cancelledNotification = Notification::factory()->cancelled()->create();

        Livewire::test('notifications.scheduled-notifications')
            ->assertSee(__('Scheduled Notifications'))
            ->assertSee($notification2->subject)
            ->assertDontSee([
                $notification1->subject,
                $processingNotification->subject,
                $finishedNotification->subject,
                $cancelledNotification->subject,
            ]);
    }
}
