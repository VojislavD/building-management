<?php

namespace Tests\Feature\Buildings;

use App\Models\Building;
use App\Enums\BuildingStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BuildingsTableLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_show_only_active_buildings_at_begining()
    {
        $active = Building::factory()->active()->create();
        $inactive = Building::factory()->inactive()->create();
        
        Livewire::test('buildings.buildings-table')
            ->assertSee($active->internal_code)
            ->assertDontSee($inactive->internal_code)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_active_inactive_or_all_buildings()
    {
        $active = Building::factory()->active()->create();
        $inactive = Building::factory()->inactive()->create();
        
        Livewire::test('buildings.buildings-table')
            ->assertSee($active->internal_code)
            ->assertDontSee($inactive->internal_code)
            ->assertHasNoErrors();

        Livewire::test('buildings.buildings-table')
            ->set('status', BuildingStatus::Inactive())
            ->assertSee($inactive->internal_code)
            ->assertDontSee($active->internal_code)
            ->assertHasNoErrors();
        
        Livewire::test('buildings.buildings-table')
            ->set('status', null)
            ->assertSee($active->internal_code)
            ->assertSee($inactive->internal_code)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_buildings_in_latest_order()
    {
        $building1 = Building::factory()->create([
            'created_at' => now()->subDays(2)
        ]);
        $building2 = Building::factory()->create([
            'created_at' => now()->subDay()
        ]);
        $building3 = Building::factory()->create();

        Livewire::test('buildings.buildings-table')
            ->assertSeeInOrder([
                $building3->internal_code,
                $building2->internal_code,
                $building1->internal_code
            ])
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_buildings_when_per_page_change()
    {
        $building1 = Building::factory()->active()->create([
            'created_at' => now()->subDay()
        ]);

        $building2 = Building::factory()->active()->create();
        Building::factory(8)->active()->create();
        $building3 = Building::factory()->active()->create();

        Livewire::test('buildings.buildings-table')
            ->assertDontSee($building1->internal_code)
            ->assertSee($building2->internal_code)
            ->assertSee($building3->internal_code)
            ->assertSeeInOrder(['Showing', '1', 'to', '10', 'of', Building::active()->count(), 'results'])
            ->assertHasNoErrors();

        Livewire::test('buildings.buildings-table')
            ->set('perPage', 15)
            ->assertSee($building1->internal_code)
            ->assertSee($building2->internal_code)
            ->assertSee($building3->internal_code)
            ->assertHasNoErrors();
    }
}
