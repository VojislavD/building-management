<?php

namespace App\Actions\Apartments;

use App\Contracts\Actions\CreatesApartment;
use App\Models\Apartment;
use App\Models\Building;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class CreateApartment implements CreatesApartment
{
    public function __invoke(Building $building, array $input): void
    {
        Validator::make($input, [
            'owner_name' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'string', 'email', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:255'],
            'owner_password' => ['required', 'string', new Password, 'confirmed'],
            'number' => ['required', 'integer', 'min:0', 'max:9999', Rule::unique('apartments')->where('building_id', $building->id)],
            'tenants' => ['required', 'integer', 'min:0', 'max:9999'],
        ])->validate();

        DB::transaction(function () use ($building, $input) {
            $owner = User::create([
                'company_id' => $building->company->id,
                'name' => $input['owner_name'],
                'email' => $input['owner_email'],
                'phone' => $input['owner_phone'],
                'password' => bcrypt($input['owner_password']),
            ]);

            Apartment::create([
                'building_id' => $building->id,
                'user_id' => $owner->id,
                'number' => $input['number'],
                'tenants' => $input['tenants'],
            ]);
        });
    }
}
