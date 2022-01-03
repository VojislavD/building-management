<?php

namespace Tests\Feature;

use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        Livewire::test('create-building')
            ->assertSeeInOrder([
                __('Internal Code'),
                __('Status'),
                __('Construction Year'),
                __('Square'),
                __('Floors'),
                __('Tenants'),
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
        $building = Building::factory()->create();

        Livewire::test('create-building')
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'required',
                'status' => 'required',
                'construction_year' => 'required',
                'square' => 'required',
                'floors' => 'required',
                'tenants' => 'required',
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

        Livewire::test('create-building', [
            'internal_code' => 1,
            'status' => 0,
            'construction_year' => 1949,
            'square' => 'not numeric',
            'floors' => 'not numeric',
            'tenants' => 'not numeric',
            'elevator' => 'not boolean',
            'yard' => 'not boolean',
            'balance_begining' => 'not numeric',
            'pib' => 'not numeric',
            'identification_number' => 'not numeric',
            'account_number' => 1,
            'address' => 1,
            'city' => 1,
            'county' => 1,
            'postal_code' => 'not numeric',
            'comment' => 1
        ])
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'string',
                'status' => 'in',
                'construction_year' => 'in',
                'square' => 'numeric',
                'floors' => 'numeric',
                'tenants' => 'numeric',
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
                'comment' => 'string'
            ]);

        Livewire::test('create-building', [
            'internal_code' => 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.',
            'status' => Building::STATUS_ACTIVE,
            'construction_year' => now()->year,
            'square' => 0,
            'floors' => -1,
            'tenants' => -1,
            'elevator' => true,
            'yard' => true,
            'balance_begining' => 123,
            'pib' => 12345678,
            'identification_number' => 1234567,
            'account_number' => $building->account_number,
            'address' => 'Some Address 123',
            'city' => 'New York',
            'county' => 'New York',
            'postal_code' => 1234,
            'comment' => 'More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters. More than 1000 characters.'
        ])
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'max',
                'square' => 'min',
                'floors' => 'min',
                'tenants' => 'min',
                'pib' => 'digits',
                'identification_number' => 'digits',
                'account_number' => 'unique',
                'postal_code' => 'digits',
                'comment' => 'max'
            ]);
        
        Livewire::test('create-building', [
            'internal_code' => "$building->internal_code",
            'status' => Building::STATUS_ACTIVE,
            'construction_year' => now()->year,
            'square' => 10,
            'floors' => 10,
            'tenants' => 10,
            'elevator' => true,
            'yard' => true,
            'balance_begining' => 123,
            'pib' => "$building->pib",
            'identification_number' => "$building->identification_number",
            'account_number' => '123-4567-89',
            'address' => 'Some Address 123',
            'city' => 'New York',
            'county' => 'New York',
            'postal_code' => 12345,
            'comment' => 'Some comment.'
        ])
            ->call('submit')
            ->assertHasErrors([
                'internal_code' => 'unique',
                'pib' => 'unique',
                'identification_number' => 'unique',
            ]);

        Livewire::test('create-building', [
                'internal_code' => "12345",
                'status' => Building::STATUS_ACTIVE,
                'construction_year' => now()->year,
                'square' => 10,
                'floors' => 10,
                'tenants' => 10,
                'elevator' => true,
                'yard' => true,
                'balance_begining' => 123,
                'pib' => "123456789",
                'identification_number' => "12345678",
                'account_number' => '123-4567-89',
                'address' => 'Some Address 123',
                'city' => 'New York',
                'county' => 'New York',
                'postal_code' => 12345,
                'comment' => 'Some comment.'
            ])
                ->call('submit')
                ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_create_new_building()
    {
        Livewire::test('create-building', [
            'internal_code' => "12345",
            'status' => Building::STATUS_ACTIVE,
            'construction_year' => now()->year,
            'square' => 10,
            'floors' => 10,
            'tenants' => 10,
            'elevator' => true,
            'yard' => true,
            'balance_begining' => 123,
            'pib' => "123456789",
            'identification_number' => "12345678",
            'account_number' => '123-4567-89',
            'address' => 'Some Address 123',
            'city' => 'New York',
            'county' => 'New York',
            'postal_code' => 12345,
            'comment' => 'Some comment.'
        ])
            ->call('submit')
            ->assertHasNoErrors();
        
        $this->assertDatabaseHas('buildings', [
            'internal_code' => "12345",
            'status' => Building::STATUS_ACTIVE,
            'construction_year' => now()->year,
            'square' => 10,
            'floors' => 10,
            'tenants' => 10,
            'elevator' => true,
            'yard' => true,
            'balance_begining' => 123,
            'pib' => "123456789",
            'identification_number' => "12345678",
            'account_number' => '123-4567-89',
            'address' => 'Some Address 123',
            'city' => 'New York',
            'county' => 'New York',
            'postal_code' => 12345,
            'comment' => 'Some comment.'
        ]);
    }
}
