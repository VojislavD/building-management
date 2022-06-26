<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\UpdatesTask;
use App\Enums\TaskStatus;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index(): Renderable
    {
        return view('tasks.index');
    }

    public function show(Task $task): Renderable
    {
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task, UpdatesTask $updater): RedirectResponse
    {
        $updater($task, ['comment' => $request->comment]);

        return to_route('tasks.index')->with('taskUpdated', __('Task successfully updated.'));
    }

    public function completed(Task $task, UpdatesTask $updater): RedirectResponse
    {
        $updater($task, ['status' => TaskStatus::Completed()]);

        return to_route('tasks.index')->with('taskCompleted', __('Task marked as completed successfully.'));
    }

    public function cancelled(Task $task, UpdatesTask $updater): RedirectResponse
    {
        $updater($task, ['status' => TaskStatus::Cancelled()]);

        return to_route('tasks.index')->with('taskCancelled', __('Task marked as cancelled successfully.'));
    }
}
