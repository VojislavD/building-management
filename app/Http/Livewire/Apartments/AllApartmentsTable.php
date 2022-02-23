<?php

namespace App\Http\Livewire\Apartments;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class AllApartmentsTable extends Component
{
    use WithPagination;

    public int|null $building_id = null;
    public int $perPage = 10;

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
        $apartments = Apartment::with('building')
            ->when($this->building_id, function($query) {
                return $query->where('building_id', $this->building_id);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.apartments.all-apartments-table', [
            'buildings' => Building::get(['id','address']),
            'apartments' => $apartments
        ]);
    }
}
