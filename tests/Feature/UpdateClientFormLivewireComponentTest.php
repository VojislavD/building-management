<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateClientFormLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_info()
    {
        Livewire::test('profile.update-client-form')
            ->assertSee(__('Name'));
    }

    /**
     * @test
     */
    public function test_client_validation()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test('profile.update-client-form')
            ->call('updateClient')
            ->assertHasErrors([
                'state.name' => 'required'
            ]);

        Livewire::test('profile.update-client-form')
            ->set('state.name', 1)
            ->call('updateClient')
            ->assertHasErrors([
                'state.name' => 'string'
            ]);

        Livewire::test('profile.update-client-form')
            ->set('state.name', 'Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.')
            ->call('updateClient')
            ->assertHasErrors([
                'state.name' => 'max'
            ]);
        
        Livewire::test('profile.update-client-form')
            ->set('state.name', 'Test Name')
            ->call('updateClient')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_update_client()
    {
        $user = User::factory()->create();
        $client_name = $user->client->name;

        $this->actingAs($user);

        Livewire::test('profile.update-client-form')
            ->set('state.name', 'Test Name')
            ->call('updateClient')
            ->assertHasNoErrors();
        
        $this->assertDatabaseMissing('clients', [
            'name' => $client_name
        ]);

        $this->assertDatabaseHas('clients', [
            'name' => 'Test Name'
        ]);
    }
}
