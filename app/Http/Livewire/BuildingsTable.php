<?php

namespace App\Http\Livewire;

use App\Models\Building;
use Livewire\Component;
use Livewire\WithPagination;

class BuildingsTable extends Component
{
    use WithPagination;
    
    public $perPage = 10;
    public $status = Building::STATUS_ACTIVE;

    public function updatingPerPage() 
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        $buildings = Building::withCount('apartments')
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.buildings-table', [
            'buildings' => $buildings
        ]);
    }
}
