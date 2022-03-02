<?php

namespace Tests\Feature\Admins;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_index_page_can_view_only_authenticated_user()
    {
        $response = $this->get(route('admins.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_index_page_show_correct_info()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('admins.index'));

        $response->assertStatus(200)
            ->assertViewIs('admins.index')
            ->assertSeeText(__('All Admins'))
            ->assertSeeText(__('New Admin'))
            ->assertSeeInOrder([
                __('Name'), 
                __('Email'),	
                __('Company'), 
                __('Created At'), 
                __('Updated At'), 
            ]);
    }

    /**
     * @test
     */
    public function test_create_page_can_view_only_authenticated_user()
    {
        $response = $this->get(route('admins.create'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_create_page_show_correct_info()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('admins.create'));

        $response->assertStatus(200)
            ->assertViewIs('admins.create')
            ->assertSeeText(__('Add New Admin'))
            ->assertSeeTextInOrder([
                __('Admin Info'), 
                __('Company'), 
                __('Name'), 
                __('Email'), 
                __('Password'), 
                __('Password Confirmation'), 
                __('Save'), 
            ]);
    }

    /**
     * @test
     */
    public function test_edit_page_can_view_only_authenticated_user()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $response = $this->get(route('admins.edit', $admin));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_edit_page_show_correct_info()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $response = $this->actingAs(User::factory()->create())
            ->get(route('admins.edit', $admin));

        $response->assertOk()
            ->assertViewIs('admins.edit')
            ->assertSeeText(__('Edit Admin'))
            ->assertSeeTextInOrder([
                __('Admin Info'), 
                __('Company'), 
                __('Name'), 
                __('Email'), 
                __('New Password'), 
                __('Save'), 
            ]);
    }

    /**
     * @test
     */
    public function test_delete_admin_can_do_only_authenticated_user()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $response = $this->delete(route('admins.delete', $admin));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_delete_admin()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $response = $this->actingAs(User::factory()->create())
            ->delete(route('admins.delete', $admin));

        $response->assertRedirect(route('admins.index'))
            ->assertSessionHas('adminDeleted');

        $this->assertDatabaseMissing('users', [
            $admin->id
        ]);
    }
}
