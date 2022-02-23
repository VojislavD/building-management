<?php

namespace App\Actions\Tasks;

use App\Contracts\Actions\UpdatesTask;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class UpdateTask implements UpdatesTask
{
    public function __invoke(Task $task, array $input): void
    {
        match (array_key_first($input)) {
            'comment' => $task->update(['comment' => $input['comment']]),
            'status' => $task->update(['status' => $input['status']])
        };
    }
}