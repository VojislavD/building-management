<?php

namespace App\Http\Livewire;

use App\Models\Building;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class AllProjectsTable extends Component
{
    use WithPagination;
    
    public $status;
    public $building_id;
    public $perPage = 10;

    public function updatingStatus() 
    {
        $this->gotoPage(1);
    }

    public function updatingBuildingId() 
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage() 
    {
        $this->gotoPage(1);
    }

    public function render()
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

        return view('livewire.all-projects-table', [
            'buildings' => Building::get(['id','address']),
            'projects' => $projects
        ]);
    }
}
