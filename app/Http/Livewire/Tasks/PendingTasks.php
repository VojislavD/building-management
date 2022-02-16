<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class PendingTasks extends Component
{
    use WithPagination;
    
    public function render()
    {
        $tasks = Task::pending()
            ->latest()
            ->paginate(5);

        return view('livewire.tasks.pending-tasks', [
            'tasks' => $tasks
        ]);
    }
}
