<?php

namespace App\Http\Livewire\Apartments;

use App\Models\Apartment;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditApartment extends Component
{
    public Apartment $apartment;
    public $internal_code;
    public $address;
    public $owner_name;
    public $owner_email;
    public $owner_phone;
    public $number;
    public $tenants;

    public function mount()
    {
        $this->fill([
            'internal_code' => $this->apartment->building->internal_code,    
            'address' => $this->apartment->building->address,
            'owner_name' => $this->apartment->owner->name,
            'owner_email' => $this->apartment->owner->email,
            'owner_phone' => $this->apartment->owner->phone, 
            'number' => $this->apartment->number,
            'tenants' => $this->apartment->tenants,
        ]);
    }

    protected function rules(): array
    {
        return [
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'string', 'email', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer', 'min:0', 'max:9999', Rule::unique('apartments')->where('building_id', $this->apartment->building->id)->ignore($this->apartment->id)],
            'tenants' => ['required', 'integer', 'min:0', 'max:9999']
        ];
    }

    public function submit(): Redirector|RedirectResponse
    {
        $this->validate();

        $oldOwner = $this->apartment->owner;

        $updateOwner = $this->apartment->owner->update([
            'name' => $this->owner_name,
            'email' => $this->owner_email,
            'phone' => $this->owner_phone
        ]);

        if ($updateOwner) {
            $updateApartment = $this->apartment->update([
                'number' => $this->number,
                'tenants' => $this->tenants
            ]);

            if ($updateApartment) {
                session()->flash('apratmentUpdated', __('Apartment successfully updated.'));
            } else {
                $this->apartment->owner->update([
                    'name' => $oldOwner->name,
                    'email' => $oldOwner->email,
                    'phone' => $oldOwner->phone
                ]);

                session()->flash('apratmentNotUpdated', __('Oops! Something went wrong, please try again.'));
            }
        } else {
            session()->flash('apratmentNotUpdated', __('Oops! Something went wrong, please try again.'));
        }

        return to_route('buildings.show', $this->apartment->building);
    }

    public function render(): Renderable
    {
        return view('livewire.apartments.edit-apartment');
    }
}
