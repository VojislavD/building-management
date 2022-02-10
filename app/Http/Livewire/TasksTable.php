<?php

namespace App\Http\Livewire;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;

    public $status;
    public $perPage = 10;

    public function mount()
    {
        $this->status = TaskStatus::Pending->value;
    }

    public function updatingStatus() 
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage() 
    {
        $this->gotoPage(1);
    }

    public function render(): Renderable
    {
        $tasks = Task::with('user', 'building')
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.tasks-table', [
            'tasks' => $tasks
        ]);
    }
}
