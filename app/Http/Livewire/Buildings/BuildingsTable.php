<?php

namespace App\Http\Livewire\Buildings;

use App\Enums\BuildingStatus;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class BuildingsTable extends Component
{
    use WithPagination;
    
    public $perPage = 10;
    public $status;

    public function mount()
    {
        $this->status = BuildingStatus::Active();
    }
    
    public function updatingPerPage() 
    {
        $this->gotoPage(1);
    }

    public function render(): Renderable
    {
        $buildings = Building::withCount('apartments')
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.buildings.buildings-table', [
            'buildings' => $buildings
        ]);
    }
}
