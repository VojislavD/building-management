<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class PendingTasks extends Component
{
    use WithPagination;

    public function render(): Renderable
    {
        $tasks = Task::pending()
            ->latest()
            ->paginate(5, ['*'], 'tasksPage');

        return view('livewire.tasks.pending-tasks', [
            'tasks' => $tasks,
        ]);
    }
}
