<?php

namespace App\Http\Livewire;

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
            'internal_code' => ['required'],
            'status' => ['required'],
            'construction_year' => ['required'],
            'square' => ['required'],
            'floors' => ['required'],
            'apartments' => ['required'],
            'tenants' => ['required'],
            'elevator' => ['required'],
            'yard' => ['required'],
            'balance_begining' => ['required'],
            'pib' => ['required'],
            'identification_number' => ['required'],
            'account_number' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'county' => ['required'],
            'postal_code' => ['required'],
            'comment' => ['required'],
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
