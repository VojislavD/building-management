<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AllProjectsTableLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $project = Project::factory()->create();
        $project2 = Project::factory()->create();

        Livewire::test('projects.all-projects-table')
            ->assertSee([
                $project->name,
                $project2->name
            ]);
    }

    /**
     * @test
     */
    public function test_that_component_shows_correct_data_when_status_is_selected()
    {
        $projectPending = Project::factory()->pending()->create();
        $projectProcessing = Project::factory()->processing()->create();
        $projectFinished = Project::factory()->finished()->create();
        $projectCancelled = Project::factory()->cancelled()->create();

        Livewire::test('projects.all-projects-table')
            ->assertSeeHtml([
                $projectPending->name,
                $projectProcessing->name,
                $projectFinished->name,
                $projectCancelled->name
            ])
            ->set('status', ProjectStatus::Pending->value)
            ->assertSee([
                $projectPending->name
            ])
            ->assertDontSee([
                $projectProcessing->name,
                $projectFinished->name,
                $projectCancelled->name
            ])
            ->set('status', ProjectStatus::Processing->value)
            ->assertSee([
                $projectProcessing->name
            ])
            ->assertDontSee([
                $projectPending->name,
                $projectFinished->name,
                $projectCancelled->name
            ])
            ->set('status', ProjectStatus::Finished->value)
            ->assertSee([
                $projectFinished->name
            ])
            ->assertDontSee([
                $projectPending->name,
                $projectProcessing->name,
                $projectCancelled->name
            ])
            ->set('status', ProjectStatus::Cancelled->value)
            ->assertSee([
                $projectCancelled->name
            ])
            ->assertDontSee([
                $projectPending->name,
                $projectProcessing->name,
                $projectFinished->name
            ]);
    }

    /**
     * @test
     */
    public function test_that_component_shows_correct_data_when_building_is_selected()
    {
        $building = Building::factory()->active()->create();
        $project = Project::factory()->for($building)->create();
        $project2 = Project::factory()->create();

        Livewire::test('projects.all-projects-table', [
                'building_id' => $building->id
            ])
            ->assertSee([
                $project->name
            ])
            ->assertDontSee([
                $project2->name
            ]);
    }

    /**
     * @test
     */
    public function test_show_projects_when_per_page_default()
    {
        $project1 = Project::factory()->create([
            'created_at' => now()->subDays(2)
        ]);

        $project2 = Project::factory()->create();
        Project::factory(8)->create();
        $project3 = Project::factory()->create();

        Livewire::test('projects.all-projects-table')
            ->assertDontSee([
                $project1->name,
            ])
            ->assertSee([
                $project2->name,
                $project3->name
            ])
            ->assertSeeInOrder(['Showing', '1', 'to', '10', 'of', Project::count(), 'results'])
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_projects_when_per_page_15()
    {
        $project1 = Project::factory()->create([
            'created_at' => now()->subDays(2)
        ]);

        $project2 = Project::factory()->create();
        Project::factory(8)->create();
        $project3 = Project::factory()->create();
        
        Livewire::test('projects.all-projects-table')
            ->set('perPage', 15)
            ->assertSee([
                $project1->name,
                $project2->name,
                $project3->name
            ])
            ->assertHasNoErrors();
    }
}
