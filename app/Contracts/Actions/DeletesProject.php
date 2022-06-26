<?php

namespace App\Contracts\Actions;

use App\Models\Project;

interface DeletesProject
{
    public function __invoke(Project $project): void;
}
