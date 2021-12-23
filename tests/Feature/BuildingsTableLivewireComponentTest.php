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
    public function test_show_only_active_buildings()
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
            ->assertHasNoErrors();
    }
}
