<?php

namespace App\Http\Livewire\Projects;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ActiveProjects extends Component
{
    use WithPagination;

    public function render()
    {
        $projects = Project::whereIn('status', [ProjectStatus::Pending, ProjectStatus::Processing])
            ->latest()
            ->paginate(5, ['*'], 'projectsPage');

        return view('livewire.projects.active-projects', [
            'projects' => $projects
        ]);
    }
}
