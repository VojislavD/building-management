<?php

namespace App\Actions\Apartments;

use App\Contracts\Actions\EditsApartment;
use App\Models\Apartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditApartment implements EditsApartment
{
    public function __invoke(Apartment $apartment, array $input): void
    {
        Validator::make($input, [
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'string', 'email', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
            'number' => ['required', 'integer', 'min:0', 'max:9999', Rule::unique('apartments')->where('building_id', $apartment->building->id)->ignore($apartment->id)],
            'tenants' => ['required', 'integer', 'min:0', 'max:9999']
        ])->validate();

        DB::transaction(function () use ($apartment, $input) {
            $apartment->owner->update([
                'name' => $input['owner_name'],
                'email' => $input['owner_email'],
                'phone' => $input['owner_phone']
            ]);

            $apartment->update([
                'number' => $input['number'],
                'tenants' => $input['tenants']
            ]);
        });
    }
}