<?php

namespace App\Http\Livewire\Apartments;

use App\Contracts\Actions\UpdatesApartment;
use App\Models\Apartment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditApartment extends Component
{
    public Apartment $apartment;
    
    public array $state = [];

    public function mount(): void
    {
        $this->fill([
            'state.internal_code' => $this->apartment->building->internal_code,    
            'state.address' => $this->apartment->building->address,
            'state.owner_name' => $this->apartment->owner->name,
            'state.owner_email' => $this->apartment->owner->email,
            'state.owner_phone' => $this->apartment->owner->phone, 
            'state.number' => $this->apartment->number,
            'state.tenants' => $this->apartment->tenants,
        ]);
    }

    public function submit(UpdatesApartment $updator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();
        
        $updator($this->apartment, $this->state);

        session()->flash('apratmentUpdated', __('Apartment successfully updated.'));

        return to_route('buildings.show', $this->apartment->building);
    }

    public function render(): Renderable
    {
        return view('livewire.apartments.edit-apartment');
    }
}
