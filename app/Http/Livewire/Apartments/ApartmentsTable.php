<?php

namespace App\Http\Livewire\Apartments;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class ApartmentsTable extends Component
{
    use WithPagination;

    public Building $building;

    public function render(): Renderable
    {
        $apartments = Apartment::where('building_id', $this->building->id)
            ->with('owner')
            ->latest()
            ->paginate(10);

        return view('livewire.apartments.apartments-table', [
            'apartments' => $apartments,
        ]);
    }
}
