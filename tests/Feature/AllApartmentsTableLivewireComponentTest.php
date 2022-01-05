<?php

namespace Tests\Feature;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AllApartmentsTableLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $apartment = Apartment::factory()->create();
        $apartment2 = Apartment::factory()->create();

        Livewire::test('all-apartments-table')
            ->assertSeeHtml([
                $apartment->number.'
                    </td>',
                $apartment2->number.'
                    </td>'
            ]);
    }

    /**
     * @test
     */
    public function test_that_component_shows_correct_data_when_building_is_selected()
    {
        $building = Building::factory()->active()->create();
        $apartment = Apartment::factory()->for($building)->create();
        $apartment2 = Apartment::factory()->create();

        Livewire::test('all-apartments-table', [
                'building_id' => $building->id
            ])
            ->assertSeeHtml([
                $apartment->number.'
                    </td>'
            ])
            ->assertDontSeeHtml([
                $apartment2->number.'
                    </td>'
            ]);
    }
}
