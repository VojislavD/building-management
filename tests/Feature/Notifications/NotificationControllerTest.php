<?php

namespace Tests\Feature\Notifications;

use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_create_page_can_view_only_authenticated_user()
    {
        $building = Building::factory()->create();

        $response = $this->get(route('notifications.create', $building));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_index_page_show_correct_info()
    {
        $building = Building::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('notifications.create', $building));

        $response->assertStatus(200)
            ->assertViewIs('notifications.create')
            ->assertSeeText(__('Send New Notification'))
            ->assertSee($building->internal_code)
            ->assertSee($building->address);
    }

    /**
     * @test
     */
    public function test_show_page_can_view_only_authenticated_user()
    {
        $notification = Notification::factory()->create();

        $response = $this->get(route('notifications.show', $notification));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_show_page_show_correct_info()
    {
        $notification = Notification::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('notifications.show', $notification));

        $response->assertOk()
            ->assertViewIs('notifications.show')
            ->assertSeeInOrder([
                $notification->building->internal_code,
                $notification->building->address,
                $notification->building->apartments->count(),
                $notification->subject,
                $notification->body,
                $notification->send_at,
                $notification->created_at,
                $notification->updated_at,
            ]);
    }

    /**
     * @test
     */
    public function test_cancel_can_do_only_authenticated_user()
    {
        $notification = Notification::factory()->create();

        $response = $this->patch(route('notifications.cancel', $notification));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_cancel_notification()
    {
        $notification = Notification::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->patch(route('notifications.cancel', $notification));

        $response->assertRedirect(route('buildings.show', $notification->building))
            ->assertSessionHas('notificationCancelled');

        $this->assertDatabaseHas('notifications', [
            'id' => $notification->id,
            'status' => NotificationStatus::Cancelled->value
        ]);
    }

    /**
     * @test
     */
    public function test_delete_can_do_only_authenticated_user()
    {
        $notification = Notification::factory()->create();

        $response = $this->delete(route('notifications.delete', $notification));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_delete_notification()
    {
        $notification = Notification::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->delete(route('notifications.delete', $notification));

        $response->assertRedirect(route('buildings.show', $notification->building))
            ->assertSessionHas('notificationDeleted');

        $this->assertDatabaseMissing('notifications', [
            $notification->id
        ]);
    }
}
