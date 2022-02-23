<?php

namespace App\Contracts\Actions;

use App\Models\Project;

interface UpdatesProject
{
    public function __invoke(Project $project, array $input): void;
}