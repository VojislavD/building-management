<?php

namespace App\Http\Livewire;

use App\Models\Building;
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
    
    public function render()
    {
        return view('livewire.create-apartment');
    }
}
