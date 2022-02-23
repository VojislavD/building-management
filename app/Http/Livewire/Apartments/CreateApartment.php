<?php

namespace App\Http\Livewire\Apartments;

use App\Contracts\Actions\CreatesApartment;
use App\Models\Apartment;
use App\Models\Building;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Laravel\Fortify\Rules\Password;

class CreateApartment extends Component
{
    public Building $building;

    public $state = [];

    public function mount()
    {
        $this->fill([
            'state.internal_code' => $this->building->internal_code,
            'state.address' => $this->building->address
        ]);
    }

    public function submit(CreatesApartment $creator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $creator($this->building, $this->state);

        session()->flash('apratmentCreated', __('Apartment successfully created.'));

        return to_route('buildings.show', $this->building);
    }
    
    public function render(): Renderable
    {
        return view('livewire.apartments.create-apartment');
    }
}
