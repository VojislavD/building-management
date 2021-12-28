<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateBuildingLivewireComponentTest extends TestCase
{
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
                __('Apartments'),
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
}
