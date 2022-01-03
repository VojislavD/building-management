<?php

namespace Tests\Feature;

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

        Livewire::test('create-apartment', [
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
}
