<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ActiveProjectsLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $pendingProject = Project::factory()->pending()->create();
        $processingProject = Project::factory()->processing()->create();
        $finishedProject = Project::factory()->finished()->create();
        $cancelledProject = Project::factory()->cancelled()->create();

        Livewire::test('projects.active-projects')
            ->assertSee(__('Active Projects'))
            ->assertSee([
                str($pendingProject->name)->limit(50),
                str($processingProject->name)->limit(50),
            ])
            ->assertDontSee([
                str($finishedProject->name)->limit(50),
                str($cancelledProject->name)->limit(50),
            ]);
    }
}
