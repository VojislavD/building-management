<?php

namespace App\Http\Livewire;

use App\Models\Apartment;
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
        $this->internal_code = $this->apartment->building->internal_code;    
        $this->address = $this->apartment->building->address;
        $this->owner_name = $this->apartment->owner->name; 
        $this->owner_email = $this->apartment->owner->email; 
        $this->owner_phone = $this->apartment->owner->phone; 
        $this->number = $this->apartment->number; 
        $this->tenants = $this->apartment->tenants; 
    }

    protected function rules()
    {
        return [
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'string', 'email', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer', 'min:0', 'max:9999', Rule::unique('apartments')->where('building_id', $this->apartment->building->id)->ignore($this->apartment->id)],
            'tenants' => ['required', 'integer', 'min:0', 'max:9999']
        ];
    }

    public function submit()
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

        return redirect()->to(route('buildings.show', $this->apartment->building));
    }

    public function render()
    {
        return view('livewire.edit-apartment');
    }
}
