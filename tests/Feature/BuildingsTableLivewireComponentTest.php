<?php

namespace Tests\Feature;

use App\Models\Building;
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
        
        Livewire::test('buildings-table')
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
        
        Livewire::test('buildings-table')
            ->assertSee($active->internal_code)
            ->assertDontSee($inactive->internal_code)
            ->assertHasNoErrors();

        Livewire::test('buildings-table')
            ->set('status', Building::STATUS_INACTIVE)
            ->assertSee($inactive->internal_code)
            ->assertDontSee($active->internal_code)
            ->assertHasNoErrors();
        
        Livewire::test('buildings-table')
            ->set('status', '')
            ->assertSee($active->internal_code)
            ->assertSee($inactive->internal_code)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_latest_ten_buildings()
    {
        $building1 = Building::factory()->create([
            'created_at' => now()->subDay()
        ]);

        $building2 = Building::factory()->create();
        Building::factory(8)->create();
        $building3 = Building::factory()->create();

        Livewire::test('buildings-table')
            ->assertDontSee($building1->internal_code)
            ->assertSee($building2->internal_code)
            ->assertSee($building3->internal_code)
            ->assertSeeInOrder(['Showing', '1', 'to', '10', 'of', Building::active()->count(), 'results'])
            ->assertHasNoErrors();
    }
}
