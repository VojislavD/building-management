<?php

namespace Tests\Feature;

use App\Models\Building;
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
            ->assertSeeText(__('New Building'))
            ->assertSeeInOrder([
                __('Internal Code'), 
                __('Address'),	
                __('Floors'), 
                __('Apartments'), 
                __('Tenants'), 
                __('Manage')
            ]);
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
            ->assertSeeText(__('Add New Building'))
            ->assertSeeTextInOrder([
                __('Basic Info'), 
                __('Internal Code'), 
                __('Status'), 
                __('Construction Year'), 
                __('Square'), 
                __('Floors'), 
                __('Apartments'), 
                __('Tenants'), 
                __('Elevator'), 
                __('Yard'), 
                __('Balance'), 
                __('Administrative Info'),
                __('PIB'), 
                __('Identification Number'), 
                __('Account Number'), 
                __('Location Info'), 
                __('Address'), 
                __('City'), 
                __('County'), 
                __('Postal Code'), 
                __('Comment'), 
                __('Save'), 
            ]);
    }

    /**
     * @test
     */
    public function test_show_page_can_view_only_authenticated_user()
    {
        $building = Building::factory()->create();

        $response = $this->get(route('buildings.show', $building));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_show_page_show_correct_info()
    {
        $building = Building::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('buildings.show', $building));

        $response->assertOk()
            ->assertViewIs('buildings.show')
            ->assertSeeInOrder([
                $building->address,
                $building->balance,
                __('Basic Info'),
                $building->internal_code
            ]);
    }

    /**
     * @test
     */
    public function test_edit_page_can_view_only_authenticated_user()
    {
        $building = Building::factory()->create();

        $response = $this->get(route('buildings.edit', $building));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_edit_page_show_correct_info()
    {
        $building = Building::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('buildings.edit', $building));

        $response->assertOk()
            ->assertViewIs('buildings.edit')
            ->assertSeeText(__('Edit Building'))
            ->assertSeeTextInOrder([
                __('Basic Info'), 
                __('Internal Code'), 
                __('Status'), 
                __('Construction Year'), 
                __('Square'), 
                __('Floors'), 
                __('Apartments'), 
                __('Tenants'), 
                __('Elevator'), 
                __('Yard'), 
                __('Balance'), 
                __('Administrative Info'),
                __('PIB'), 
                __('Identification Number'), 
                __('Account Number'), 
                __('Location Info'), 
                __('Address'), 
                __('City'), 
                __('County'), 
                __('Postal Code'), 
                __('Comment'), 
                __('Save'), 
            ]);
    }

    /**
     * @test
     */
    public function test_delete_building_can_do_only_authenticated_user()
    {
        $building = Building::factory()->create();

        $response = $this->delete(route('buildings.delete', $building));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_delete_building()
    {
        $building = Building::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->delete(route('buildings.delete', $building));

        $response->assertRedirect(route('buildings.index'))
            ->assertSessionHas('buildingDeleted');

        $this->assertDatabaseMissing('buildings', [
            $building->id
        ]);
    }
}
