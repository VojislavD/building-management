<?php

namespace Tests\Feature\Admins;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AdminsTableLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_show_correct_informations()
    {
        $admin = User::factory()->create()->assignRole('admin');

        Livewire::test('admins.admins-table')
            ->assertSeeInOrder([
                $admin->name,
                $admin->email,
                $admin->company->name,
                $admin->created_at->toFormattedDateString(),
                $admin->updated_at->toFormattedDateString(),
            ])
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_admins_in_latest_order()
    {
        $admin1 = User::factory()->create([
            'created_at' => now()->subDays(2)
        ])->assignRole('admin');

        $admin2 = User::factory()->create([
            'created_at' => now()->subDay()
        ])->assignRole('admin');
        
        $admin3 = User::factory()->create()->assignRole('admin');

        Livewire::test('admins.admins-table')
            ->assertSeeInOrder([
                $admin3->email,
                $admin2->email,
                $admin1->email
            ])
            ->assertHasNoErrors();
    }
}
