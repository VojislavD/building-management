<?php

namespace App\Http\Livewire\Buildings;

use App\Enums\BuildingStatus;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateBuilding extends Component
{
    public $internal_code;
    public $status;
    public $construction_year;
    public $square;
    public $floors;
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
    
    protected function rules(): array
    {
        return [
            'internal_code' => ['required', 'string', 'max:255', 'unique:buildings'],
            'status' => ['required', Rule::in([BuildingStatus::Active->value, BuildingStatus::Inactive->value])],
            'construction_year' => ['required', Rule::in(Building::availableConstructionYears())],
            'square' => ['required', 'numeric', 'min:1'],
            'floors' => ['required', 'numeric', 'min:0'],
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

    public function submit(): Redirector|RedirectResponse
    {
        $this->validate();

        $newBuilding = Building::create([
            'company_id' => auth()->user()->company->id,
            'internal_code' => $this->internal_code,
            'status' => $this->status,
            'construction_year' => $this->construction_year,
            'square' => $this->square,
            'floors' => $this->floors,
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

        return to_route('buildings.index');
    }
    
    public function render(): Renderable
    {
        return view('livewire.buildings.create-building');
    }
}
