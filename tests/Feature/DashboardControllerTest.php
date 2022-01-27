<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_dashboard_page_can_view_only_authenticated_user()
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_dashboard_page_show_correct_menu_items()
    {
        $user = User::factory()
            ->create()
            ->assignRole('user');

        $admin = User::factory()
            ->create()
            ->assignRole('admin');

        $super_admin = User::factory()
            ->create()
            ->assignRole('super_admin');

        $response = $this->actingAs($user)
            ->get(route('dashboard'));

        $response->assertStatus(200)
            ->assertViewIs('dashboard')
            ->assertSeeText(__('Dashboard'))
            ->assertSeeText(__('Tasks'))
            ->assertSeeText(__('Projects'))
            ->assertDontSeeText(__('Buildings'))
            ->assertDontSeeText(__('Apartments'));

        $response = $this->actingAs($admin)
            ->get(route('dashboard'));

        $response->assertStatus(200)
            ->assertViewIs('dashboard')
            ->assertSeeText(__('Dashboard'))
            ->assertSeeText(__('Buildings'))
            ->assertSeeText(__('Apartments'))
            ->assertSeeText(__('Tasks'))
            ->assertSeeText(__('Projects'));

        $response = $this->actingAs($super_admin)
            ->get(route('dashboard'));

        $response->assertStatus(200)
            ->assertViewIs('dashboard')
            ->assertSeeText(__('Dashboard'))
            ->assertSeeText(__('Buildings'))
            ->assertSeeText(__('Apartments'))
            ->assertSeeText(__('Tasks'))
            ->assertSeeText(__('Projects'));
    }
}
