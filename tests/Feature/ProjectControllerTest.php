<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_index_page_can_view_only_authenticated_user()
    {
        $response = $this->get(route('projects.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_index_page_show_correct_info()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('projects.index'));

        $response->assertStatus(200)
            ->assertViewIs('projects.index')
            ->assertSeeText(__('All Projects'));
    }

    /**
     * @test
     */
    public function test_edit_page_can_view_only_authenticated_user()
    {
        $project = Project::factory()->create();

        $response = $this->get(route('projects.edit', $project));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_edit_page_show_correct_info()
    {
        $project = Project::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('projects.edit', $project));

        $response->assertStatus(200)
            ->assertViewIs('projects.edit')
            ->assertSeeText(__('Edit Project'))
            ->assertSeeInOrder([
                $project->building->internal_code,
                $project->building->address,
                $project->status,
                $project->name,
                $project->price,
                $project->rates,
                $project->amount_payed,
                $project->amount_left,
                $project->start_paying->format('Y-m-d'),
                $project->end_paying->format('Y-m-d'),
                __('Save'),
                __('Delete Project')
            ]);
    }

    /**
     * @test
     */
    public function test_only_authenticated_user_can_delete_project()
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.delete', $project));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_delete_project()
    {
        $project = Project::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->delete(route('projects.delete', $project));

        $response->assertRedirect(route('projects.index'))
            ->assertSessionHas('projectDeleted');
        
        $this->assertDatabaseMissing('projects', [
            'id' => $project->id
        ]);
    }
}
