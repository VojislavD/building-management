<?php

namespace App\Contracts\Actions;

use App\Models\Task;

interface UpdatesTask
{
    public function __invoke(Task $task, array $input): void;
}
