<?php

namespace Tests\Feature;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_index_page_can_view_only_authenticated_user()
    {
        $response = $this->get(route('apartments.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_index_page_show_correct_info()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('apartments.index'));

        $response->assertStatus(200)
            ->assertViewIs('apartments.index')
            ->assertSeeText(__('All Apartments'));
    }

    /**
     * @test
     */
    public function test_create_page_can_view_only_authenticated_user()
    {
        $building = Building::factory()->create();

        $response = $this->get(route('apartments.create', $building));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_create_page_show_correct_info()
    {
        $building = Building::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('apartments.create', $building));

        $response->assertStatus(200)
            ->assertViewIs('apartments.create')
            ->assertSeeText(__('Add New Apartment'))
            ->assertSeeInOrder([
                __('Building Info'), 
                __('Internal Code'),
                __('Address'), 
                __('Owner Info'), 
                __('Name'), 
                __('Email Address'),
                __('Phone Number'),
                __('Apartment Info'),
                __('Number'),
                __('Tenants'),
            ]);
    }

    /**
     * @test
     */
    public function test_edit_page_can_view_only_authenticated_user()
    {
        $apartment = Apartment::factory()->create();

        $response = $this->get(route('apartments.edit', $apartment));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_edit_page_show_correct_info()
    {
        $apartment = Apartment::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('apartments.edit', $apartment));

        $response->assertStatus(200)
            ->assertViewIs('apartments.edit')
            ->assertSeeText(__('Edit Apartment'))
            ->assertSeeInOrder([
                $apartment->building->internal_code,
                $apartment->building->address,
                $apartment->owner->name,
                $apartment->owner->email,
                $apartment->owner->phone,
                $apartment->number,
                $apartment->tenants,
                __('Save'),
                __('Delete Apartment')
            ]);
    }
}
