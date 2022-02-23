<?php

namespace App\Http\Livewire\Buildings;

use App\Contracts\Actions\CreatesBuilding;
use App\Enums\BuildingStatus;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateBuilding extends Component
{
    public array $state = [];

    public function submit(CreatesBuilding $creator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $creator(auth()->user()->company, $this->state);
        
        session()->flash('buildingCreated', __('New building successfully created.'));

        return to_route('buildings.index');
    }
    
    public function render(): Renderable
    {
        return view('livewire.buildings.create-building');
    }
}
