<?php

namespace App\Actions\Buildings;

use App\Contracts\Actions\UpdatesBuilding;
use App\Enums\BuildingStatus;
use App\Models\Building;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateBuilding implements UpdatesBuilding
{
    public function __invoke(Building $building, array $input): void
    {
        Validator::make($input, [
            'internal_code' => ['required', 'string', 'max:255', Rule::unique('buildings')->ignore($building->id)],
            'status' => ['required', Rule::in([BuildingStatus::Active(), BuildingStatus::Inactive()])],
            'construction_year' => ['required', Rule::in(Building::availableConstructionYears())],
            'square' => ['required', 'numeric', 'min:1'],
            'floors' => ['required', 'numeric', 'min:0'],
            'elevator' => ['required', 'boolean'],
            'yard' => ['required', 'boolean'],
            'balance' => ['required', 'numeric'],
            'pib' => ['required', 'numeric', 'digits:9', Rule::unique('buildings')->ignore($building->id)],
            'identification_number' => ['required', 'numeric', 'digits:8', Rule::unique('buildings')->ignore($building->id)],
            'account_number' => ['required', 'string', Rule::unique('buildings')->ignore($building->id)],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'county' => ['required', 'string'],
            'postal_code' => ['required', 'numeric', 'digits:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ])->validate();

        $building->update([
            'internal_code' => $input['internal_code'],
            'status' => $input['status'],
            'construction_year' => $input['construction_year'],
            'square' => $input['square'],
            'floors' => $input['floors'],
            'elevator' => $input['elevator'],
            'yard' => $input['yard'],
            'balance' => $input['balance'],
            'pib' => $input['pib'],
            'identification_number' => $input['identification_number'],
            'account_number' => $input['account_number'],
            'address' => $input['address'],
            'city' => $input['city'],
            'county' => $input['county'],
            'postal_code' => $input['postal_code'],
            'comment' => $input['comment'],
        ]);
    }
}
