<?php

namespace App\Http\Livewire;

use App\Models\Building;
use Livewire\Component;
use Livewire\WithPagination;

class BuildingsTable extends Component
{
    use WithPagination;
    
    public $perPage = 10;

    public function updatingPerPage() 
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        return view('livewire.buildings-table', [
            'buildings' => Building::active()->latest()->paginate($this->perPage)
        ]);
    }
}
