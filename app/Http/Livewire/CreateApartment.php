<?php

namespace App\Http\Livewire;

use App\Models\Building;
use Livewire\Component;

class CreateApartment extends Component
{
    public Building $building;
    
    public function render()
    {
        return view('livewire.create-apartment');
    }
}
