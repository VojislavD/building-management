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

    public int $perPage = 10;

    public int|null $status = null;

    public function mount(): void
    {
        $this->fill(['status' => BuildingStatus::Active()]);
    }

    public function updatingPerPage(): void
    {
        $this->gotoPage(1);
    }

    public function render(): Renderable
    {
        $buildings = Building::withCount('apartments')
            ->when($this->status, function ($query) {
                return $query->where('status', $this->status);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.buildings.buildings-table', [
            'buildings' => $buildings,
        ]);
    }
}
