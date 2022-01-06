<?php

namespace Tests\Feature;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
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

    /**
     * @test
     */
    public function test_show_apartments_when_per_page_change()
    {
        $apartment1 = Apartment::factory()->create([
            'created_at' => now()->subDay()
        ]);

        $apartment2 = Apartment::factory()->create();
        Apartment::factory(8)->create();
        $apartment3 = Apartment::factory()->create();

        Livewire::test('all-apartments-table')
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
        
        Livewire::test('all-apartments-table')
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
