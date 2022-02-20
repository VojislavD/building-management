<?php

namespace App\Http\Livewire\Buildings;

use App\Enums\BuildingStatus;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditBuilding extends Component
{
    public Building $building;

    public $internal_code;
    public $status;
    public $construction_year;
    public $square;
    public $floors;
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

    public function mount()
    {
        $this->internal_code = $this->building->internal_code;
        $this->status = $this->building->status->value;
        $this->construction_year = $this->building->construction_year;
        $this->square = $this->building->square;
        $this->floors = $this->building->floors;
        $this->elevator = $this->building->elevator;
        $this->yard = $this->building->yard;
        $this->balance = $this->building->balance;
        $this->pib = $this->building->pib;
        $this->identification_number = $this->building->identification_number;
        $this->account_number = $this->building->account_number;
        $this->address = $this->building->address;
        $this->city = $this->building->city;
        $this->county = $this->building->county;
        $this->postal_code = $this->building->postal_code;
        $this->comment = $this->building->comment;
    }

    protected function rules(): array
    {
        return [
            'internal_code' => ['required', 'string', 'max:255', Rule::unique('buildings')->ignore($this->building->id)],
            'status' => ['required', Rule::in([BuildingStatus::Active(), BuildingStatus::Inactive()])],
            'construction_year' => ['required', Rule::in(Building::availableConstructionYears())],
            'square' => ['required', 'numeric', 'min:1'],
            'floors' => ['required', 'numeric', 'min:0'],
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

    public function submit(): Redirector|RedirectResponse
    {
        $this->validate();
        
        $updatedBuilding = $this->building->update([
            'internal_code' => $this->internal_code,
            'status' => $this->status,
            'construction_year' => $this->construction_year,
            'square' => $this->square,
            'floors' => $this->floors,
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

        return to_route('buildings.index');
    }

    public function render(): Renderable
    {
        return view('livewire.buildings.edit-building');
    }
}
