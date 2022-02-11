<?php

namespace Tests\Feature\Notifications;

use App\Models\Building;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateNotificationLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_are_present()
    {
        $building = Building::factory()->create();

        Livewire::test('notifications.create-notification', [
                'building' => $building
            ])
            ->assertSeeInOrder([
                __('Internal Code'),
                __('Address'),
                __('Subject'),
                __('Body'),
                __('Send Notification Via:'),
                __('Send Notification:'),
                __('Send'),
            ])
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_validation()
    {
        $building = Building::factory()->create();

        Livewire::test('notifications.create-notification', [
                'building' => $building
            ])
            ->call('submit')
            ->assertHasErrors([
                'subject' => 'required',
                'body' => 'required',
                'via_email' => 'accepted'
            ]);

        Livewire::test('notifications.create-notification', [
                'building' => $building
            ])
            ->set('send_scheduled', true)
            ->call('submit')
            ->assertHasErrors([
                'subject' => 'required',
                'body' => 'required',
                'via_email' => 'accepted',
                'scheduled_date' => 'required',
                'scheduled_time' => 'required'
            ]);

        Livewire::test('notifications.create-notification', [
                'building' => $building
            ])
            ->set('send_scheduled', true)
            ->set('subject', 1)
            ->set('body', 1)
            ->set('via_email', 'not boolean')
            ->set('scheduled_date', 'not date')
            ->set('scheduled_time', 'not time')
            ->call('submit')
            ->assertHasErrors([
                'subject' => 'string',
                'body' => 'string',
                'via_email' => 'accepted',
                'scheduled_date' => 'date',
                'scheduled_time' => 'date_format'
            ]);

        Livewire::test('notifications.create-notification', [
                'building' => $building
            ])
            ->set('send_scheduled', true)
            ->set('subject', 'Text greater than 255 characters. Text greater than 255 characters. Text greater than 255 characters. Text greater than 255 characters. Text greater than 255 characters. Text greater than 255 characters. Text greater than 255 characters. Text greater than 255 characters.')
            ->set('body', 1)
            ->set('via_email', true)
            ->set('scheduled_date', now()->format('Y-m-d'))
            ->set('scheduled_time', now()->format('H:i'))
            ->call('submit')
            ->assertHasErrors([
                'subject' => 'max',
            ]);
        
        Livewire::test('notifications.create-notification', [
                'building' => $building
            ])
            ->set('send_scheduled', true)
            ->set('subject', 'Example subject')
            ->set('body', 'Example body.')
            ->set('via_email', true)
            ->set('scheduled_date', now()->format('Y-m-d'))
            ->set('scheduled_time', now()->format('H:i'))
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_create_new_notification()
    {
        $building = Building::factory()->create();
        $date = now()->format('Y-m-d');
        $time = now()->format('H:i');

        Livewire::test('notifications.create-notification', [
                'building' => $building
            ])
            ->set('send_scheduled', true)
            ->set('subject', 'Example subject')
            ->set('body', 'Example body.')
            ->set('via_email', true)
            ->set('scheduled_date', $date)
            ->set('scheduled_time', $time)
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('notifications', [
            'building_id' => $building->id,
            'via_email' => 1,
            'subject' => 'Example subject',
            'body' => 'Example body.',
            'send_at' => Carbon::createFromFormat('Y-m-d H:i', $date.' '.$time)
        ]);
    }
}
