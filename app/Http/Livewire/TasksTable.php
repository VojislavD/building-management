<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class TasksTable extends Component
{
    public function render()
    {
        return view('livewire.tasks-table', [
            'tasks' => Task::latest()->paginate(10)
        ]);
    }
}
