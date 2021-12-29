<?php

namespace App\Http\Livewire;

use App\Models\Apartment;
use App\Models\Building;
use Livewire\Component;
use Livewire\WithPagination;

class ApartmentsTable extends Component
{
    use WithPagination;

    private $building_id;

    public function mount($building_id)
    {
        $this->building_id = $building_id;
    }

    public function render()
    {
        $apartments = Apartment::where('building_id', $this->building_id)
            ->with('owner')
            ->latest()
            ->paginate(10);

        return view('livewire.apartments-table', [
            'apartments' => $apartments
        ]);
    }
}
