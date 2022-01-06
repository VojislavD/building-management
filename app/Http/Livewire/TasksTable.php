<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;

    public $status = Task::STATUS_PENDING;
    public $perPage = 10;

    public function updatingStatus() 
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage() 
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        $tasks = Task::when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.tasks-table', [
            'tasks' => $tasks
        ]);
    }
}
