<?php

namespace Tests\Feature\Buildings;

use App\Enums\BuildingStatus;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
            'building' => $building,
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
            ->assertSet('state.internal_code', $building->internal_code)
            ->assertSet('state.status', $building->status->value)
            ->assertSet('state.construction_year', $building->construction_year)
            ->assertSet('state.sqaure', $building->sqaure)
            ->assertSet('state.floors', $building->floors)
            ->assertSet('state.elevator', $building->elevator)
            ->assertSet('state.yard', $building->yard)
            ->assertSet('state.balance', $building->balance)
            ->assertSet('state.pib', $building->pib)
            ->assertSet('state.identification_number', $building->identification_number)
            ->assertSet('state.account_number', $building->account_number)
            ->assertSet('state.address', $building->address)
            ->assertSet('state.city', $building->city)
            ->assertSet('state.county', $building->county)
            ->assertSet('state.postal_code', $building->postal_code)
            ->assertSet('state.comment', $building->comment)
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
            'building' => $building,
        ])
            ->set('state.internal_code', '')
            ->set('state.status', '')
            ->set('state.construction_year', '')
            ->set('state.square', '')
            ->set('state.floors', '')
            ->set('state.elevator', '')
            ->set('state.yard', '')
            ->set('state.balance', '')
            ->set('state.pib', '')
            ->set('state.identification_number', '')
            ->set('state.account_number', '')
            ->set('state.address', '')
            ->set('state.city', '')
            ->set('state.county', '')
            ->set('state.postal_code', '')
            ->set('state.comment', '')
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
            'building' => $building,
        ])
            ->set('state.internal_code', 1)
            ->set('state.status', 0)
            ->set('state.construction_year', 1949)
            ->set('state.square', 'not numeric')
            ->set('state.floors', 'not numeric')
            ->set('state.elevator', 'not boolean')
            ->set('state.yard', 'not boolean')
            ->set('state.balance', 'not numeric')
            ->set('state.pib', 'not numeric')
            ->set('state.identification_number', 'not numeric')
            ->set('state.account_number', 1)
            ->set('state.address', 1)
            ->set('state.city', 1)
            ->set('state.county', 1)
            ->set('state.postal_code', 'not numeric')
            ->set('state.comment', 1)
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
            'building' => $building,
        ])
            ->set('state.internal_code', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('state.status', BuildingStatus::Active())
            ->set('state.construction_year', now()->year)
            ->set('state.square', 0)
            ->set('state.floors', -1)
            ->set('state.elevator', true)
            ->set('state.yard', true)
            ->set('state.balance', 100)
            ->set('state.pib', 12345678)
            ->set('state.identification_number', 1234567)
            ->set('state.account_number', $building2->account_number)
            ->set('state.address', 'Some Random Street')
            ->set('state.city', 'New York')
            ->set('state.county', 'New York')
            ->set('state.postal_code', 1234)
            ->set('state.comment', 'More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters.')
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
            'building' => $building,
        ])
            ->set('state.internal_code', "$building2->internal_code")
            ->set('state.status', BuildingStatus::Active())
            ->set('state.construction_year', now()->year)
            ->set('state.square', 1)
            ->set('state.floors', 1)
            ->set('state.elevator', true)
            ->set('state.yard', true)
            ->set('state.balance', 100)
            ->set('state.pib', $building2->pib)
            ->set('state.identification_number', $building2->identification_number)
            ->set('state.account_number', $building->account_number)
            ->set('state.address', 'Some Random Street')
            ->set('state.city', 'New York')
            ->set('state.county', 'New York')
            ->set('state.postal_code', 12345)
            ->set('state.comment', 'Some random comment.')
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'unique',
                'pib' => 'unique',
                'identification_number' => 'unique',
            ]);

        Livewire::test('buildings.edit-building', [
            'building' => $building,
        ])
            ->set('state.internal_code', "$building->internal_code")
            ->set('state.status', BuildingStatus::Active())
            ->set('state.construction_year', now()->year)
            ->set('state.square', 1)
            ->set('state.floors', 1)
            ->set('state.elevator', true)
            ->set('state.yard', true)
            ->set('state.balance', 100)
            ->set('state.pib', $building->pib)
            ->set('state.identification_number', $building->identification_number)
            ->set('state.account_number', $building->account_number)
            ->set('state.address', 'Some Random Street')
            ->set('state.city', 'New York')
            ->set('state.county', 'New York')
            ->set('state.postal_code', 12345)
            ->set('state.comment', 'Some random comment.')
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
            'building' => $building,
        ])
            ->set('state.internal_code', '12345')
            ->set('state.status', BuildingStatus::Inactive())
            ->set('state.construction_year', $building->construction_year - 1)
            ->set('state.square', $building->square + 10)
            ->set('state.floors', $building->floors + 10)
            ->set('state.elevator', false)
            ->set('state.yard', false)
            ->set('state.balance', $building->balance + 10)
            ->set('state.pib', '111111111')
            ->set('state.identification_number', '11111111')
            ->set('state.account_number', '111-11111-11')
            ->set('state.address', 'Some Random Street')
            ->set('state.city', 'New York')
            ->set('state.county', 'New York')
            ->set('state.postal_code', 11111)
            ->set('state.comment', 'Some random comment.')
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
                'internal_code' => '12345',
                'status' => BuildingStatus::Inactive(),
                'construction_year' => $building->construction_year - 1,
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
                'comment' => 'Some random comment.',
            ]);
    }
}
