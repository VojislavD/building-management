<?php

namespace Tests\Feature\Buildings;

use App\Enums\BuildingStatus;
use App\Models\Building;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateBuildingLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_are_present()
    {
        Livewire::test('buildings.create-building')
            ->assertSeeInOrder([
                __('Internal Code'),
                __('Status'),
                __('Construction Year'),
                __('Square'),
                __('Floors'),
                __('Elevator'),
                __('Yard'),
                __('Balance Begining'),
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
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_validation()
    {
        $this->actingAs(User::factory()->create());

        $building = Building::factory()->create();

        Livewire::test('buildings.create-building')
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'required',
                'status' => 'required',
                'construction_year' => 'required',
                'square' => 'required',
                'floors' => 'required',
                'elevator' => 'required',
                'yard' => 'required',
                'balance_begining' => 'required',
                'pib' => 'required',
                'identification_number' => 'required',
                'account_number' => 'required',
                'address' => 'required',
                'city' => 'required',
                'county' => 'required',
                'postal_code' => 'required',
            ]);

        Livewire::test('buildings.create-building')
            ->set('state.internal_code', 1)
            ->set('state.status', 0)
            ->set('state.construction_year', 1949)
            ->set('state.square', 'not numeric')
            ->set('state.floors', 'not numeric')
            ->set('state.elevator', 'not boolean')
            ->set('state.yard', 'not boolean')
            ->set('state.balance_begining', 'not numeric')
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
                'balance_begining' => 'numeric',
                'pib' => 'numeric',
                'identification_number' => 'numeric',
                'account_number' => 'string',
                'address' => 'string',
                'city' => 'string',
                'county' => 'string',
                'postal_code' => 'numeric',
                'comment' => 'string',
            ]);

        Livewire::test('buildings.create-building')
            ->set('state.internal_code', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('state.status', BuildingStatus::Active())
            ->set('state.construction_year', now()->year)
            ->set('state.square', 0)
            ->set('state.floors', -1)
            ->set('state.elevator', true)
            ->set('state.yard', true)
            ->set('state.balance_begining', 123)
            ->set('state.pib', 12345678)
            ->set('state.identification_number', 1234567)
            ->set('state.account_number', $building->account_number)
            ->set('state.address', 'Some Address 123')
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

        Livewire::test('buildings.create-building')
            ->set('state.internal_code', "$building->internal_code")
            ->set('state.status', BuildingStatus::Active())
            ->set('state.construction_year', now()->year)
            ->set('state.square', 10)
            ->set('state.floors', 10)
            ->set('state.elevator', true)
            ->set('state.yard', true)
            ->set('state.balance_begining', 123)
            ->set('state.pib', "$building->pib")
            ->set('state.identification_number', "$building->identification_number")
            ->set('state.account_number', '123-4567-89')
            ->set('state.address', 'Some Address 123')
            ->set('state.city', 'New York')
            ->set('state.county', 'New York')
            ->set('state.postal_code', 12345)
            ->set('state.comment', 'Some comment.')
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'unique',
                'pib' => 'unique',
                'identification_number' => 'unique',
            ]);

        Livewire::test('buildings.create-building')
                ->set('state.internal_code', '12345')
                ->set('state.status', BuildingStatus::Active())
                ->set('state.construction_year', now()->year)
                ->set('state.square', 10)
                ->set('state.floors', 10)
                ->set('state.elevator', true)
                ->set('state.yard', true)
                ->set('state.balance_begining', 123)
                ->set('state.pib', '123456789')
                ->set('state.identification_number', '12345678')
                ->set('state.account_number', '123-4567-89')
                ->set('state.address', 'Some Address 123')
                ->set('state.city', 'New York')
                ->set('state.county', 'New York')
                ->set('state.postal_code', 12345)
                ->set('state.comment', 'Some comment.')
                ->call('submit')
                ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_create_new_building()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test('buildings.create-building')
            ->set('state.internal_code', '12345')
            ->set('state.status', BuildingStatus::Active())
            ->set('state.construction_year', now()->year)
            ->set('state.square', 10)
            ->set('state.floors', 10)
            ->set('state.elevator', true)
            ->set('state.yard', true)
            ->set('state.balance_begining', 123)
            ->set('state.pib', '123456789')
            ->set('state.identification_number', '12345678')
            ->set('state.account_number', '123-4567-89')
            ->set('state.address', 'Some Address 123')
            ->set('state.city', 'New York')
            ->set('state.county', 'New York')
            ->set('state.postal_code', 12345)
            ->set('state.comment', 'Some comment.')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('buildings', [
            'internal_code' => '12345',
            'status' => BuildingStatus::Active(),
            'construction_year' => now()->year,
            'square' => 10,
            'floors' => 10,
            'elevator' => true,
            'yard' => true,
            'balance_begining' => 123,
            'pib' => '123456789',
            'identification_number' => '12345678',
            'account_number' => '123-4567-89',
            'address' => 'Some Address 123',
            'city' => 'New York',
            'county' => 'New York',
            'postal_code' => 12345,
            'comment' => 'Some comment.',
        ]);
    }
}
