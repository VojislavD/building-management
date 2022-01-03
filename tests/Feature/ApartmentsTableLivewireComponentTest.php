<?php

namespace Tests\Feature;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use Tests\TestCase;

class ApartmentsTableLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $building = Building::factory()->active()->create();
        $apartment = Apartment::factory()->for($building)->create();

        Livewire::test('apartments-table', [
                'building' => $building
            ])
            ->assertSee([
                $apartment->number,
            ]);
    }
}
