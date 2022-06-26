<?php

namespace Tests\Feature\Apartments;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        Livewire::test('apartments.all-apartments-table')
            ->assertSeeHtml([
                $apartment->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
                $apartment2->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
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

        Livewire::test('apartments.all-apartments-table', [
            'building_id' => $building->id,
        ])
            ->assertSeeHtml([
                $apartment->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
            ])
            ->assertDontSeeHtml([
                $apartment2->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
            ]);
    }

    /**
     * @test
     */
    public function test_show_apartments_when_per_page_default()
    {
        $building = Building::factory()->create();

        $apartment1 = Apartment::factory()->for($building)->create([
            'created_at' => now()->subDays(2),
        ]);

        $apartment2 = Apartment::factory()->for($building)->create();
        Apartment::factory(8)->for($building)->create();
        $apartment3 = Apartment::factory()->for($building)->create();

        Livewire::test('apartments.all-apartments-table')
            ->assertDontSeeHtml([
                $apartment1->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
            ])
            ->assertSeeHtml([
                $apartment2->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
                $apartment3->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
            ])
            ->assertSeeInOrder(['Showing', '1', 'to', '10', 'of', Apartment::count(), 'results'])
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_apartments_when_per_page_15()
    {
        $apartment1 = Apartment::factory()->create([
            'created_at' => now()->subDays(2),
        ]);

        $apartment2 = Apartment::factory()->create();
        Apartment::factory(8)->create();
        $apartment3 = Apartment::factory()->create();

        Livewire::test('apartments.all-apartments-table')
            ->set('perPage', 15)
            ->assertSeeHtml([
                $apartment1->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
                $apartment2->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
                $apartment3->number.'
                    </td>
                    <td class="py-3 pl-2 capitalize">',
            ])
            ->assertHasNoErrors();
    }
}
