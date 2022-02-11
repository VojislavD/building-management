<?php

namespace Tests\Feature\Companies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateCompanyFormLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_info()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test('profile.update-company-form')
            ->assertSee(__('Name'));
    }

    /**
     * @test
     */
    public function test_company_validation()
    {
        $this->actingAs(User::factory()->create());
        $company2 = Company::factory()->create();
        
        Livewire::test('profile.update-company-form')
            ->set('state.name', '')
            ->call('updateCompany')
            ->assertHasErrors([
                'state.name' => 'required'
            ]);

        Livewire::test('profile.update-company-form')
            ->set('state.name', 1)
            ->call('updateCompany')
            ->assertHasErrors([
                'state.name' => 'string'
            ]);

        Livewire::test('profile.update-company-form')
            ->set('state.name', 'Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.Length greater than 255 characters.')
            ->call('updateCompany')
            ->assertHasErrors([
                'state.name' => 'max'
            ]);
        
        Livewire::test('profile.update-company-form')
            ->set('state.name', $company2->name)
            ->call('updateCompany')
            ->assertHasErrors([
                'state.name' => 'unique'
            ]);
        
        Livewire::test('profile.update-company-form')
            ->set('state.name', 'Test Name')
            ->call('updateCompany')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_update_company()
    {
        $user = User::factory()->create();
        $company_name = $user->company->name;

        $this->actingAs($user);

        Livewire::test('profile.update-company-form')
            ->set('state.name', 'Test Name')
            ->call('updateCompany')
            ->assertHasNoErrors();
        
        $this->assertDatabaseMissing('companies', [
            'name' => $company_name
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Name'
        ]);
    }
}
