<?php

namespace App\Http\Livewire;

use App\Models\Building;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditBuilding extends Component
{
    public $building;

    public $internal_code;
    public $status;
    public $construction_year;
    public $square;
    public $floors;
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
        $this->building = $building;

        $this->internal_code = $building->internal_code;
        $this->status = $building->status;
        $this->construction_year = $building->construction_year;
        $this->square = $building->square;
        $this->floors = $building->floors;
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

    protected function rules()
    {
        return [
            'internal_code' => ['required', 'string', 'max:255', Rule::unique('buildings')->ignore($this->building->id)],
            'status' => ['required', Rule::in([Building::STATUS_ACTIVE, Building::STATUS_INACTIVE])],
            'construction_year' => ['required', Rule::in(Building::availableConstructionYears())],
            'square' => ['required', 'numeric', 'min:1'],
            'floors' => ['required', 'numeric', 'min:0'],
            'tenants' => ['required', 'numeric', 'min:0'],
            'elevator' => ['required', 'boolean'],
            'yard' => ['required', 'boolean'],
            'balance' => ['required', 'numeric'],
            'pib' => ['required', 'numeric', 'digits:9', Rule::unique('buildings')->ignore($this->building->id)],
            'identification_number' => ['required', 'numeric', 'digits:8', Rule::unique('buildings')->ignore($this->building->id)],
            'account_number' => ['required', 'string', Rule::unique('buildings')->ignore($this->building->id)],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'county' => ['required', 'string'],
            'postal_code' => ['required', 'numeric', 'digits:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function submit()
    {
        $this->validate();
        
        $updatedBuilding = $this->building->update([
            'internal_code' => $this->internal_code,
            'status' => $this->status,
            'construction_year' => $this->construction_year,
            'square' => $this->square,
            'floors' => $this->floors,
            'tenants' => $this->tenants,
            'elevator' => $this->elevator,
            'yard' => $this->yard,
            'balance' => $this->balance,
            'pib' => $this->pib,
            'identification_number' => $this->identification_number,
            'account_number' => $this->account_number,
            'address' => $this->address,
            'city' => $this->city,
            'county' => $this->county,
            'postal_code' => $this->postal_code,
            'comment' => $this->comment
        ]);

        if ($updatedBuilding) {
            session()->flash('buildingUpdated', __('Building is successfully updated.'));
        } else {
            session()->flash('buildingNotUpdated', __('Oops! Something went wrong, please try again.'));
        }

        return redirect()->to(route('buildings.index'));
    }

    public function render()
    {
        return view('livewire.edit-building');
    }
}
