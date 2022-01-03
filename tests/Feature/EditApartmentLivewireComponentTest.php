<?php

namespace Tests\Feature;

use App\Models\Apartment;
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
}
