<?php

namespace Tests\Feature;

use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditBuildingLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_have_correct_value()
    {
        $building = Building::factory()->create();

        Livewire::test('edit-building', [
            'building' => $building
        ])
            ->assertSeeInOrder([
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
                __('PIB'),
                __('Identification Number'),
                __('Account Number'),
                __('Address'),
                __('City'),
                __('County'),
                __('Postal Code'),
                __('Comment'),
                __('Save'),
            ])
            ->assertSet('internal_code', $building->internal_code)
            ->assertSet('status', $building->status)
            ->assertSet('construction_year', $building->construction_year)
            ->assertSet('sqaure', $building->sqaure)
            ->assertSet('floors', $building->floors)
            ->assertSet('apartments', $building->apartments)
            ->assertSet('tenants', $building->tenants)
            ->assertSet('elevator', $building->elevator)
            ->assertSet('yard', $building->yard)
            ->assertSet('balance', $building->balance)
            ->assertSet('pib', $building->pib)
            ->assertSet('identification_number', $building->identification_number)
            ->assertSet('account_number', $building->account_number)
            ->assertSet('address', $building->address)
            ->assertSet('city', $building->city)
            ->assertSet('county', $building->county)
            ->assertSet('postal_code', $building->postal_code)
            ->assertSet('comment', $building->comment)
            ->assertHasNoErrors();
    }
}
