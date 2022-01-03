<?php

namespace App\Http\Livewire;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Tenant;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateApartment extends Component
{
    public Building $building;

    public $internal_code;
    public $address;
    public $owner_name;
    public $owner_email;
    public $owner_phone;
    public $number;
    public $tenants;

    public function mount()
    {
        $this->internal_code = $this->building->internal_code;
        $this->address = $this->building->address;
    }

    protected function rules()
    {
        return [
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'string', 'email', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer', 'min:0', 'max:9999', Rule::unique('apartments')->where('building_id', $this->building->id)],
            'tenants' => ['required', 'integer', 'min:0', 'max:9999']
        ];
    }

    public function submit()
    {
        $this->validate();

        $owner = Tenant::create([
            'name' => $this->owner_name,
            'email' => $this->owner_email,
            'phone' => $this->owner_phone
        ]);

        if ($owner instanceof Tenant) {
            $apartment = Apartment::create([
                'building_id' => $this->building->id,
                'tenant_id' => $owner->id,
                'number' => $this->number,
                'tenants' => $this->tenants
            ]);

            if ($apartment instanceof Apartment) {
                session()->flash('apratmentCreated', __('Apartment successfully created.'));
            } else {
                session()->flash('apratmentNotCreated', __('Oops! Something went wrong, please try again.'));
            }
        } else {
            session()->flash('apratmentNotCreated', __('Oops! Something went wrong, please try again.'));
        }

        return redirect()->to(route('buildings.show', $this->building));
    }
    
    public function render()
    {
        return view('livewire.create-apartment');
    }
}
