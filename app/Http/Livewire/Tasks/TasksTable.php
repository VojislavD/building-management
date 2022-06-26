<?php

namespace App\Http\Livewire\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;

    public int|null $status;

    public int $perPage = 10;

    public function mount(): void
    {
        $this->fill(['status' => TaskStatus::Pending()]);
    }

    public function updatingStatus(): void
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage(): void
    {
        $this->gotoPage(1);
    }

    public function render(): Renderable
    {
        $tasks = Task::with('user', 'building')
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.tasks.tasks-table', [
            'tasks' => $tasks,
        ]);
    }
}
