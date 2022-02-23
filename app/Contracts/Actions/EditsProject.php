<?php

namespace App\Contracts\Actions;

use App\Models\Project;

interface EditsProject
{
    public function __invoke(Project $project, array $input): void;
}