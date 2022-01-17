<?php

namespace Tests\Feature;

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

        Livewire::test('edit-apartment', [
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

        Livewire::test('edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('owner_name', '')
            ->set('owner_email', '')
            ->set('owner_phone', '')
            ->set('number', '')
            ->set('tenants', '')
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'required',
                'owner_email' => 'required',
                'owner_phone' => 'required',
                'number' => 'required',
                'tenants' => 'required',
            ]);
        
        Livewire::test('edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('owner_name', 1)
            ->set('owner_email', 1)
            ->set('owner_phone', 1)
            ->set('number', 'Not Integer')
            ->set('tenants', 'Not Integer')
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'string',
                'owner_email' => 'string',
                'owner_phone' => 'string',
                'number' => 'integer',
                'tenants' => 'integer',
            ]);
        
        Livewire::test('edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('owner_name', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('owner_email', 'notvalidemail')
            ->set('owner_phone', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('number', -1)
            ->set('tenants', -1)
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'max',
                'owner_email' => 'email',
                'owner_phone' => 'max',
                'number' => 'min',
                'tenants' => 'min',
            ]);
        
        Livewire::test('edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('owner_phone', '0641234567')
            ->set('number', 10000)
            ->set('tenants', 10000)
            ->call('submit')
            ->assertHasErrors([
                'owner_email' => 'max',
                'number' => 'max',
                'tenants' => 'max',
            ]);

        Livewire::test('edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'testuser@example.com')
            ->set('owner_phone', '0641234567')
            ->set('number', $apartment2->number)
            ->set('tenants', 15)
            ->call('submit')
            ->assertHasErrors([
                'number' => 'unique',
            ]);

        Livewire::test('edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'testuser@example.com')
            ->set('owner_phone', '0641234567')
            ->set('number', $apartment->number)
            ->set('tenants', 15)
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_edit_apartment()
    {
        $apartment = Apartment::factory()->create();

        Livewire::test('edit-apartment', [
                'apartment' => $apartment
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'testuser@example.com')
            ->set('owner_phone', '0641234567')
            ->set('number', $apartment->number + 1)
            ->set('tenants', $apartment->tenants + 1)
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
