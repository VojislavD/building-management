<?php

namespace App\Http\Livewire\Buildings;

use App\Contracts\Actions\UpdatesBuilding;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class EditBuilding extends Component
{
    public Building $building;

    public array $state = [];

    public function mount(): void
    {
        $this->fill([
            'state.internal_code' => $this->building->internal_code,
            'state.status' => $this->building->status->value,
            'state.construction_year' => $this->building->construction_year,
            'state.square' => $this->building->square,
            'state.floors' => $this->building->floors,
            'state.elevator' => $this->building->elevator,
            'state.yard' => $this->building->yard,
            'state.balance' => $this->building->balance,
            'state.pib' => $this->building->pib,
            'state.identification_number' => $this->building->identification_number,
            'state.account_number' => $this->building->account_number,
            'state.address' => $this->building->address,
            'state.city' => $this->building->city,
            'state.county' => $this->building->county,
            'state.postal_code' => $this->building->postal_code,
            'state.comment' => $this->building->comment
        ]);
    }

    public function submit(UpdatesBuilding $updator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $updator($this->building, $this->state);

        session()->flash('buildingUpdated', __('Building is successfully updated.'));
        return to_route('buildings.index');
    }

    public function render(): Renderable
    {
        return view('livewire.buildings.edit-building');
    }
}
