<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): Renderable
    {
        return view('tasks.index');
    }

    public function show(Task $task): Renderable
    {
        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $updateTask = $task->update([
            'comment' => $request->comment
        ]);

        if ($updateTask) {
            return to_route('tasks.index')->with('taskUpdated', __('Task successfully updated.'));
        } else {
            return to_route('tasks.index')->with('taskNotUpdated', __('Oops! Something went wrong, please try again.'));
        }
    }

    public function completed(Task $task): RedirectResponse
    {
        $taskCompleted = $task->update([
            'status' => Task::STATUS_COMPLETED
        ]);

        if ($taskCompleted) {
            return to_route('tasks.index')->with('taskCompleted', __('Task marked as completed successfully.'));
        } else {
            return to_route('tasks.index')->with('taskNotCompleted', __('Oops! Something went wrong, please try again.'));
        }
    }

    public function cancelled(Task $task): RedirectResponse
    {
        $taskCancelled = $task->update([
            'status' => Task::STATUS_CANCELLED
        ]);

        if ($taskCancelled) {
            return to_route('tasks.index')->with('taskCancelled', __('Task marked as cancelled successfully.'));
        } else {
            return to_route('tasks.index')->with('taskNotCancelled', __('Oops! Something went wrong, please try again.'));
        }
    }
}
