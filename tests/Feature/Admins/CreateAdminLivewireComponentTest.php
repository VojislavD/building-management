<?php

namespace Tests\Feature\Admins;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class CreateAdminLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_are_present()
    {
        Livewire::test('admins.create-admin')
            ->assertSeeInOrder([
                __('Company'),
                __('Name'),
                __('Email'),
                __('Password'),
                __('Password Confirmation'),
                __('Save'),
            ])
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_validation()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        Livewire::test('admins.create-admin')
            ->call('submit')
            ->assertHasErrors([
                'company_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

        Livewire::test('admins.create-admin')
            ->set('state.company_id', 1)
            ->set('state.name', 1)
            ->set('state.email', 1)
            ->set('state.password', 1)
            ->call('submit')
            ->assertHasErrors([
                'company_id' => 'string',
                'name' => 'string',
                'email' => 'string',
                'password' => 'string',
            ]);

        Livewire::test('admins.create-admin')
            ->set('state.company_id', '9999')
            ->set('state.name', 'Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters.')
            ->set('state.email', 'not valid email address')
            ->set('state.password', 'password')
            ->call('submit')
            ->assertHasErrors([
                'company_id' => 'exists',
                'name' => 'max',
                'email' => 'email',
            ]);
        
        Livewire::test('admins.create-admin')
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'New Admin')
            ->set('state.email', 'emailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreater@example.com')
            ->set('state.password', 'password')
            ->call('submit')
            ->assertHasErrors([
                'email' => 'max',
            ]);
        
        Livewire::test('admins.create-admin')
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'New Admin')
            ->set('state.email', $user->email)
            ->set('state.password', 'password')
            ->call('submit')
            ->assertHasErrors([
                'email' => 'unique',
            ]);
        
        Livewire::test('admins.create-admin')
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'Admin')
            ->set('state.email', 'admin@example.com')
            ->set('state.password', 'password')
            ->call('submit')
            ->assertHasErrors([
                'password' => 'confirmed',
            ]);

        Livewire::test('admins.create-admin')
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'Admin')
            ->set('state.email', 'admin@example.com')
            ->set('state.password', 'password')
            ->set('state.password_confirmation', 'password')
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_create_new_admin()
    {
        $company = Company::factory()->create();

        Livewire::test('admins.create-admin')
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'Admin')
            ->set('state.email', 'admin@example.com')
            ->set('state.password', 'password')
            ->set('state.password_confirmation', 'password')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('users', [
            'company_id' => $company->id,
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        
        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id' => 1
        ]);
    }
}
