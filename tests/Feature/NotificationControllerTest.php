<?php

namespace Tests\Feature;

use App\Models\Building;
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
}
