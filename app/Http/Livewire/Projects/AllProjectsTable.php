<?php

namespace App\Http\Livewire\Projects;

use App\Models\Building;
use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class AllProjectsTable extends Component
{
    use WithPagination;
    
    public int|null $status = null;
    public int|null $building_id = null;
    public int $perPage = 10;

    public function updatingStatus(): void
    {
        $this->gotoPage(1);
    }

    public function updatingBuildingId(): void
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage(): void
    {
        $this->gotoPage(1);
    }

    public function render(): Renderable
    {
        $projects = Project::with('building')
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->building_id, function($query) {
                return $query->where('building_id', $this->building_id);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.projects.all-projects-table', [
            'buildings' => Building::get(['id','address']),
            'projects' => $projects
        ]);
    }
}
