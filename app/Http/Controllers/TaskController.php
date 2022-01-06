<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $updateTask = $task->update([
            'comment' => $request->comment
        ]);

        if ($updateTask) {
            return redirect()->to(route('tasks.index'))->with('taskUpdated', __('Task successfully updated.'));
        } else {
            return redirect()->to(route('tasks.index'))->with('taskNotUpdated', __('Oops! Something went wrong, please try again.'));
        }
    }

    public function completed(Task $task)
    {
        $taskCompleted = $task->update([
            'status' => Task::STATUS_COMPLETED
        ]);

        if ($taskCompleted) {
            return redirect()->to(route('tasks.index'))->with('taskCompleted', __('Task marked as completed successfully.'));
        } else {
            return redirect()->to(route('tasks.index'))->with('taskNotCompleted', __('Oops! Something went wrong, please try again.'));
        }
    }

    public function cancelled(Task $task)
    {
        $taskCancelled = $task->update([
            'status' => Task::STATUS_CANCELLED
        ]);

        if ($taskCancelled) {
            return redirect()->to(route('tasks.index'))->with('taskCancelled', __('Task marked as cancelled successfully.'));
        } else {
            return redirect()->to(route('tasks.index'))->with('taskNotCancelled', __('Oops! Something went wrong, please try again.'));
        }
    }
}
