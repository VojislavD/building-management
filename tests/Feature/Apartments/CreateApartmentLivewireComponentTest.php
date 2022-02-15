<?php

namespace Tests\Feature\Apartments;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateApartmentLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_are_present()
    {
        $building = Building::factory()->create();

        Livewire::test('apartments.create-apartment', [
                'building' => $building
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

        Livewire::test('apartments.create-apartment', [
                'building' => $building
            ])
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'required',
                'owner_email' => 'required',
                'owner_phone' => 'required',
                'owner_password' => 'required',
                'number' => 'required',
                'tenants' => 'required',
            ]);

        Livewire::test('apartments.create-apartment', [
                'building' => $building
            ])
            ->set('owner_name', 1)
            ->set('owner_email', 1)
            ->set('owner_phone', 1)
            ->set('owner_password', 1)
            ->set('number', 'Not Integer')
            ->set('tenants', 'Not Integer')
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'string',
                'owner_email' => 'string',
                'owner_phone' => 'string',
                'owner_password' => 'string',
                'number' => 'integer',
                'tenants' => 'integer',
            ]);
        
        Livewire::test('apartments.create-apartment', [
                'building' => $building
            ])
            ->set('owner_name', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('owner_email', 'notvalidemail')
            ->set('owner_phone', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('owner_password', 'Test')
            ->set('number', -1)
            ->set('tenants', -1)
            ->call('submit')
            ->assertHasErrors([
                'owner_name' => 'max',
                'owner_email' => 'email',
                'owner_phone' => 'max',
                //'owner_password' => 'min',
                'number' => 'min',
                'tenants' => 'min',
            ]);

        Livewire::test('apartments.create-apartment', [
                'building' => $building
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('owner_phone', '0641234567')
            ->set('owner_password', 'password')
            ->set('number', 10000)
            ->set('tenants', 10000)
            ->call('submit')
            ->assertHasErrors([
                'owner_email' => 'max',
                'owner_password' => 'confirmed',
                'number' => 'max',
                'tenants' => 'max',
            ]);
                
        Livewire::test('apartments.create-apartment', [
                'building' => $building
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'testuser@example.com')
            ->set('owner_phone', '0641234567')
            ->set('owner_password', 'password')
            ->set('owner_password_confirmation', 'password')
            ->set('number', $apartment->number)
            ->set('tenants', 15)
            ->call('submit')
            ->assertHasErrors([
                'number' => 'unique',
            ]);
        
        Livewire::test('apartments.create-apartment', [
                'building' => $building
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'testuser@example.com')
            ->set('owner_phone', '0641234567')
            ->set('owner_password', 'password')
            ->set('owner_password_confirmation', 'password')
            ->set('number', $apartment->number+1)
            ->set('tenants', 15)
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_create_apartment()
    {
        $building = Building::factory()->create();

        Livewire::test('apartments.create-apartment', [
                'building' => $building
            ])
            ->set('owner_name', 'Test User')
            ->set('owner_email', 'testuser@example.com')
            ->set('owner_phone', '0641234567')
            ->set('owner_password', 'password')
            ->set('owner_password_confirmation', 'password')
            ->set('number', 10)
            ->set('tenants', 15)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect(route('buildings.show', $building));
    
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '0641234567'
        ]);

        $this->assertDatabaseHas('apartments', [
            'building_id' => $building->id,
            'user_id' => 1,
            'number' => 10,
            'tenants' => 15
        ]);
    }
}