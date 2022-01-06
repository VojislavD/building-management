<?php

namespace App\Http\Livewire;

use App\Models\Apartment;
use App\Models\Building;
use Livewire\Component;
use Livewire\WithPagination;

class AllApartmentsTable extends Component
{
    use WithPagination;

    public $building_id;
    public $perPage = 10;

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
        $apartments = Apartment::with('building')
            ->when($this->building_id, function($query) {
                return $query->where('building_id', $this->building_id);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.all-apartments-table', [
            'buildings' => Building::get(['id','address']),
            'apartments' => $apartments
        ]);
    }
}
