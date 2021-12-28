<?php

namespace App\Http\Livewire;

use App\Models\Building;
use Livewire\Component;

class EditBuilding extends Component
{
    public $internal_code;
    public $status;
    public $construction_year;
    public $square;
    public $floors;
    public $apartments;
    public $tenants;
    public $elevator;
    public $yard;
    public $balance;
    public $pib;
    public $identification_number;
    public $account_number;
    public $address;
    public $city;
    public $county;
    public $postal_code;
    public $comment;

    public function mount(Building $building)
    {
        $this->internal_code = $building->internal_code;
        $this->status = $building->status;
        $this->construction_year = $building->construction_year;
        $this->square = $building->square;
        $this->floors = $building->floors;
        $this->apartments = $building->apartments;
        $this->tenants = $building->tenants;
        $this->elevator = $building->elevator;
        $this->yard = $building->yard;
        $this->balance = $building->balance;
        $this->pib = $building->pib;
        $this->identification_number = $building->identification_number;
        $this->account_number = $building->account_number;
        $this->address = $building->address;
        $this->city = $building->city;
        $this->county = $building->county;
        $this->postal_code = $building->postal_code;
        $this->comment = $building->comment;
    }

    public function render()
    {
        return view('livewire.edit-building');
    }
}
