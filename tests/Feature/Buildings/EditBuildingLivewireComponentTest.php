<?php

namespace Tests\Feature\Buildings;

use App\Models\Building;
use App\Enums\BuildingStatus;
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

        Livewire::test('buildings.edit-building', [
            'building' => $building
        ])
            ->assertSeeInOrder([
                __('Internal Code'),
                __('Status'),
                __('Construction Year'),
                __('Square'),
                __('Floors'),
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
            ->assertSet('status', $building->status->value)
            ->assertSet('construction_year', $building->construction_year)
            ->assertSet('sqaure', $building->sqaure)
            ->assertSet('floors', $building->floors)
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

    /**
     * @test
     */
    public function test_validation()
    {
        $building = Building::factory()->create();
        $building2 = Building::factory()->create();

        Livewire::test('buildings.edit-building', [
            'building' => $building
        ])
            ->set('internal_code', '')
            ->set('status', '')
            ->set('construction_year', '')
            ->set('square', '')
            ->set('floors', '')
            ->set('elevator', '')
            ->set('yard', '')
            ->set('balance', '')
            ->set('pib', '')
            ->set('identification_number', '')
            ->set('account_number', '')
            ->set('address', '')
            ->set('city', '')
            ->set('county', '')
            ->set('postal_code', '')
            ->set('comment', '')
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'required',
                'status' => 'required',
                'construction_year' => 'required',
                'square' => 'required',
                'floors' => 'required',
                'elevator' => 'required',
                'yard' => 'required',
                'balance' => 'required',
                'pib' => 'required',
                'identification_number' => 'required',
                'account_number' => 'required',
                'address' => 'required',
                'city' => 'required',
                'county' => 'required',
                'postal_code' => 'required',
            ]);

        Livewire::test('buildings.edit-building', [
            'building' => $building
        ])
            ->set('internal_code', 1)
            ->set('status', 0)
            ->set('construction_year', 1949)
            ->set('square', 'not numeric')
            ->set('floors', 'not numeric')
            ->set('elevator', 'not boolean')
            ->set('yard', 'not boolean')
            ->set('balance', 'not numeric')
            ->set('pib', 'not numeric')
            ->set('identification_number', 'not numeric')
            ->set('account_number', 1)
            ->set('address', 1)
            ->set('city', 1)
            ->set('county', 1)
            ->set('postal_code', 'not numeric')
            ->set('comment', 1)
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'string',
                'status' => 'in',
                'construction_year' => 'in',
                'square' => 'numeric',
                'floors' => 'numeric',
                'elevator' => 'boolean',
                'yard' => 'boolean',
                'balance' => 'numeric',
                'pib' => 'numeric',
                'identification_number' => 'numeric',
                'account_number' => 'string',
                'address' => 'string',
                'city' => 'string',
                'county' => 'string',
                'postal_code' => 'numeric',
                'comment' => 'string',
            ]);

        Livewire::test('buildings.edit-building', [
            'building' => $building
        ])
            ->set('internal_code', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('status', BuildingStatus::Active())
            ->set('construction_year', now()->year)
            ->set('square', 0)
            ->set('floors', -1)
            ->set('elevator', true)
            ->set('yard', true)
            ->set('balance', 100)
            ->set('pib', 12345678)
            ->set('identification_number', 1234567)
            ->set('account_number', $building2->account_number)
            ->set('address', 'Some Random Street')
            ->set('city', 'New York')
            ->set('county', 'New York')
            ->set('postal_code', 1234)
            ->set('comment', 'More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters.')
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'max',
                'square' => 'min',
                'floors' => 'min',
                'pib' => 'digits',
                'identification_number' => 'digits',
                'account_number' => 'unique',
                'postal_code' => 'digits',
                'comment' => 'max',
            ]);

        Livewire::test('buildings.edit-building', [
            'building' => $building
        ])
            ->set('internal_code', "$building2->internal_code")
            ->set('status', BuildingStatus::Active())
            ->set('construction_year', now()->year)
            ->set('square', 1)
            ->set('floors', 1)
            ->set('elevator', true)
            ->set('yard', true)
            ->set('balance', 100)
            ->set('pib', $building2->pib)
            ->set('identification_number', $building2->identification_number)
            ->set('account_number', $building->account_number)
            ->set('address', 'Some Random Street')
            ->set('city', 'New York')
            ->set('county', 'New York')
            ->set('postal_code', 12345)
            ->set('comment', 'Some random comment.')
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'unique',
                'pib' => 'unique',
                'identification_number' => 'unique',
            ]);

        Livewire::test('buildings.edit-building', [
            'building' => $building
        ])
            ->set('internal_code', "$building->internal_code")
            ->set('status', BuildingStatus::Active())
            ->set('construction_year', now()->year)
            ->set('square', 1)
            ->set('floors', 1)
            ->set('elevator', true)
            ->set('yard', true)
            ->set('balance', 100)
            ->set('pib', $building->pib)
            ->set('identification_number', $building->identification_number)
            ->set('account_number', $building->account_number)
            ->set('address', 'Some Random Street')
            ->set('city', 'New York')
            ->set('county', 'New York')
            ->set('postal_code', 12345)
            ->set('comment', 'Some random comment.')
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_update_building()
    {
        $building = Building::factory()->active()->create();

        Livewire::test('buildings.edit-building', [
            'building' => $building
        ])
            ->set('internal_code', "12345")
            ->set('status', BuildingStatus::Inactive())
            ->set('construction_year', $building->construction_year-1)
            ->set('square', $building->square + 10)
            ->set('floors', $building->floors + 10)
            ->set('elevator', false)
            ->set('yard', false)
            ->set('balance', $building->balance + 10)
            ->set('pib', '111111111')
            ->set('identification_number', '11111111')
            ->set('account_number', '111-11111-11')
            ->set('address', 'Some Random Street')
            ->set('city', 'New York')
            ->set('county', 'New York')
            ->set('postal_code', 11111)
            ->set('comment', 'Some random comment.')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('buildings', [
                'internal_code' => $building->internal_code,
                'status' => $building->status,
                'construction_year' => $building->construction_year,
                'square' => $building->square,
                'floors' => $building->floors,
                'elevator' => $building->elevator,
                'yard' => $building->yard,
                'balance' => $building->balance,
                'pib' => $building->pib,
                'identification_number' => $building->identification_number,
                'account_number' => $building->account_number,
                'address' => $building->address,
                'city' => $building->city,
                'county' => $building->county,
                'postal_code' => $building->postal_code,
                'comment' => $building->comment,
            ])
            ->assertDatabaseHas('buildings', [
                'internal_code' => "12345",
                'status' => BuildingStatus::Inactive(),
                'construction_year' => $building->construction_year-1,
                'square' => $building->square + 10,
                'floors' => $building->floors + 10,
                'elevator' => false,
                'yard' => false,
                'balance' => $building->balance + 10,
                'pib' => '111111111',
                'identification_number' => '11111111',
                'account_number' => '111-11111-11',
                'address' => 'Some Random Street',
                'city' => 'New York',
                'county' => 'New York',
                'postal_code' => '11111',
                'comment' => 'Some random comment.'
            ]);
    }
}
