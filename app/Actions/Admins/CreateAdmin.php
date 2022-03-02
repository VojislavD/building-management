<?php

namespace App\Actions\Admins;

use App\Actions\Fortify\PasswordValidationRules;
use App\Contracts\Actions\CreatesAdmin;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin implements CreatesAdmin
{
    use PasswordValidationRules;

    public function __invoke(array $input): void
    {
        Validator::make($input, [
            'company_id' => ['required', 'string', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        DB::transaction(function () use ($input) {

            $admin = User::create([
                'company_id' => $input['company_id'],
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
            
            $admin->assignRole('admin');
        }, 3);
    }
}