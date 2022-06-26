<?php

namespace App\Actions\Projects;

use App\Contracts\Actions\DeletesProject;
use App\Models\Project;

class DeleteProject implements DeletesProject
{
    public function __invoke(Project $project): void
    {
        $project->delete();
    }
}
