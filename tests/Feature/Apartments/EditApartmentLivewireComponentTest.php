<?php

namespace Tests\Feature\Apartments;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditApartmentLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_are_present()
    {
        $apartment = Apartment::factory()->create();

        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->assertSeeInOrder([
                __('Internal Code'),
                __('Address'),
                __('Name'),
                __('Email Address'),
                __('Phone Number'),
                __('Number'),
                __('Tenants'),
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
        $apartment = Apartment::factory()->for($building)->create();
        $apartment2 = Apartment::factory()->for($building)->create();

        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('state.owner_name', '')
            ->set('state.owner_email', '')
            ->set('state.owner_phone', '')
            ->set('state.number', '')
            ->set('state.tenants', '')
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'required',
                'owner_email' => 'required',
                'owner_phone' => 'required',
                'number' => 'required',
                'tenants' => 'required',
            ]);
        
        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('state.owner_name', 1)
            ->set('state.owner_email', 1)
            ->set('state.owner_phone', 1)
            ->set('state.number', 'Not Integer')
            ->set('state.tenants', 'Not Integer')
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'string',
                'owner_email' => 'string',
                'owner_phone' => 'string',
                'number' => 'integer',
                'tenants' => 'integer',
            ]);
        
        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('state.owner_name', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('state.owner_email', 'notvalidemail')
            ->set('state.owner_phone', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('state.number', -1)
            ->set('state.tenants', -1)
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'max',
                'owner_email' => 'email',
                'owner_phone' => 'max',
                'number' => 'min',
                'tenants' => 'min',
            ]);
        
        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('state.owner_name', 'Test User')
            ->set('state.owner_email', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('state.owner_phone', '0641234567')
            ->set('state.number', 10000)
            ->set('state.tenants', 10000)
            ->call('submit')
            ->assertHasErrors([
                'owner_email' => 'max',
                'number' => 'max',
                'tenants' => 'max',
            ]);

        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('state.owner_name', 'Test User')
            ->set('state.owner_email', 'testuser@example.com')
            ->set('state.owner_phone', '0641234567')
            ->set('state.number', $apartment2->number)
            ->set('state.tenants', 15)
            ->call('submit')
            ->assertHasErrors([
                'number' => 'unique',
            ]);

        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('state.owner_name', 'Test User')
            ->set('state.owner_email', 'testuser@example.com')
            ->set('state.owner_phone', '0641234567')
            ->set('state.number', $apartment->number)
            ->set('state.tenants', 15)
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_edit_apartment()
    {
        $apartment = Apartment::factory()->create();

        Livewire::test('apartments.edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('state.owner_name', 'Test User')
            ->set('state.owner_email', 'testuser@example.com')
            ->set('state.owner_phone', '0641234567')
            ->set('state.number', $apartment->number + 1)
            ->set('state.tenants', $apartment->tenants + 1)
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('users', [
            'name' => $apartment->owner->name,
            'email' => $apartment->owner->email,
            'phone' => $apartment->owner->phone
        ]);

        $this->assertDatabaseMissing('apartments', [
            'number' => $apartment->number,
            'tenants' => $apartment->tenants
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '0641234567'
        ]);

        $this->assertDatabaseHas('apartments', [
            'number' => $apartment->number + 1,
            'tenants' => $apartment->tenants + 1
        ]);
    }
}
