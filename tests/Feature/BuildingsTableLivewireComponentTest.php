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
    public function testShowLatestTenBuildingsInTable()
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
