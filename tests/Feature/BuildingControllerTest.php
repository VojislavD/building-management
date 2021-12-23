<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BuildingControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_index_page_can_view_only_authenticated_user()
    {
        $response = $this->get(route('buildings.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_index_page_show_correct_info()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('buildings.index'));

        $response->assertStatus(200)
            ->assertViewIs('buildings.index')
            ->assertSeeText(__('All Buildings'))
            ->assertSeeText(__('Add Building'))
            ->assertSeeInOrder(['Internal Code', 'Address',	'Floors', 'Apartments', 'Tenants', 'Manage']);
    }

    /**
     * @test
     */
    public function test_create_page_can_view_only_authenticated_user()
    {
        $response = $this->get(route('buildings.create'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_create_page_show_correct_info()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('buildings.create'));

        $response->assertStatus(200)
            ->assertViewIs('buildings.create')
            ->assertSeeText(__('Add New Building'));
    }
}
