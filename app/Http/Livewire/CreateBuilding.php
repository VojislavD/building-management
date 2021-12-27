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
            'internal_code' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in([Building::STATUS_ACTIVE, Building::STATUS_INACTIVE])],
            'construction_year' => ['required', Rule::in(Building::availableConstructionYears())],
            'square' => ['required', 'numeric', 'min:1'],
            'floors' => ['required', 'numeric', 'min:0'],
            'apartments' => ['required', 'numeric', 'min:1'],
            'tenants' => ['required', 'numeric', 'min:0'],
            'elevator' => ['required', 'boolean'],
            'yard' => ['required', 'boolean'],
            'balance_begining' => ['required', 'numeric'],
            'pib' => ['required', 'numeric', 'digits:9'],
            'identification_number' => ['required', 'numeric', 'digits:8'],
            'account_number' => ['required', 'string'],
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
    }
    
    public function render()
    {
        return view('livewire.create-building');
    }
}
