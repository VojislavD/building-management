<?php

namespace Tests\Feature\Admins;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditAdminLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_have_correct_value()
    {
        $admin = User::factory()->create()->assignRole('admin');

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->assertSeeInOrder([
                __('Company'),
                __('Name'),
                __('Email'),
                __('New Password'),
                __('Save'),
            ])
            ->assertSet('state.company_id', $admin->company_id)
            ->assertSet('state.name', $admin->name)
            ->assertSet('state.email', $admin->email)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_validation()
    {
        $admin = User::factory()->create()->assignRole('admin');
        $user = User::factory()->create();

        $company = Company::factory()->create();

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->set('state.company_id', '')
            ->set('state.name', '')
            ->set('state.email', '')
            ->set('state.password', '')
            ->call('submit')
            ->assertHasErrors([
                'company_id' => 'required',
                'name' => 'required',
                'email' => 'required',
            ]);

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->set('state.company_id', 9999)
            ->set('state.name', 1)
            ->set('state.email', 'not valid email')
            ->set('state.password', 1)
            ->call('submit')
            ->assertHasErrors([
                'company_id' => 'exists',
                'name' => 'string',
                'email' => 'email',
                'password' => 'string',
            ]);

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters. Greater than 255 characters.')
            ->set('state.email', 'emailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreaterthan255charactersemailgreater@example.com')
            ->set('state.password', '')
            ->call('submit')
            ->assertHasErrors([
                'name' => 'max',
                'email' => 'max',
            ]);

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'New Name')
            ->set('state.email', $user->email)
            ->set('state.password', '')
            ->call('submit')
            ->assertHasErrors([
                'email' => 'unique',
            ]);

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'New Name')
            ->set('state.email', $admin->email)
            ->set('state.password', 'password')
            ->call('submit')
            ->assertHasNoErrors();

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'New Name')
            ->set('state.email', 'newemail@example.com')
            ->set('state.password', 'password')
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_update_admin()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $company = Company::factory()->create();

        Livewire::test('admins.edit-admin', [
            'admin' => $admin
        ])
            ->set('state.company_id', "$company->id")
            ->set('state.name', 'New Name')
            ->set('state.email', 'newemail@example.com')
            ->set('state.password', 'password')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'company_id' => $company->id,
            'name' => 'New Name',
            'email' => 'newemail@example.com',
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => 2,
            'model_type' => 'App\Models\User',
            'model_id' => $admin->id
        ]);

    }
}
