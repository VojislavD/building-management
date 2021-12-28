<?php

namespace App\Http\Livewire;

use App\Models\Building;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateBuilding extends Component
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
    public $balance_begining;
    public $pib;
    public $identification_number;
    public $account_number;
    public $address;
    public $city;
    public $county;
    public $postal_code;
    public $comment;
    
    protected function rules()
    {
        return [
            'internal_code' => ['required', 'string', 'max:255', 'unique:buildings'],
            'status' => ['required', Rule::in([Building::STATUS_ACTIVE, Building::STATUS_INACTIVE])],
            'construction_year' => ['required', Rule::in(Building::availableConstructionYears())],
            'square' => ['required', 'numeric', 'min:1'],
            'floors' => ['required', 'numeric', 'min:0'],
            'apartments' => ['required', 'numeric', 'min:1'],
            'tenants' => ['required', 'numeric', 'min:0'],
            'elevator' => ['required', 'boolean'],
            'yard' => ['required', 'boolean'],
            'balance_begining' => ['required', 'numeric'],
            'pib' => ['required', 'numeric', 'digits:9', 'unique:buildings'],
            'identification_number' => ['required', 'numeric', 'digits:8', 'unique:buildings'],
            'account_number' => ['required', 'string', 'unique:buildings'],
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

        $newBuilding = Building::create([
            'internal_code' => $this->internal_code,
            'status' => $this->status,
            'construction_year' => $this->construction_year,
            'square' => $this->square,
            'floors' => $this->floors,
            'apartments' => $this->apartments,
            'tenants' => $this->tenants,
            'elevator' => $this->elevator,
            'yard' => $this->yard,
            'balance_begining' => $this->balance_begining,
            'balance' => $this->balance_begining,
            'pib' => $this->pib,
            'identification_number' => $this->identification_number,
            'account_number' => $this->account_number,
            'address' => $this->address,
            'city' => $this->city,
            'county' => $this->county,
            'postal_code' => $this->postal_code,
            'comment' => $this->comment
        ]);
        
        if ($newBuilding instanceof Building) {
            session()->flash('buildingCreated', __('New building successfully created.'));
        } else {
            session()->flash('buildingNotCreated', __('Oops! Something went wrong, please try again.'));
        }

        return redirect()->to(route('buildings.index'));
    }
    
    public function render()
    {
        return view('livewire.create-building');
    }
}
