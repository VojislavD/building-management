<?php

namespace App\Actions\Admins;

use App\Actions\Fortify\PasswordValidationRules;
use App\Contracts\Actions\UpdatesAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class UpdateAdmin implements UpdatesAdmin
{
    use PasswordValidationRules;

    public function __invoke(User $admin, array $input): void
    {
        Validator::make($input, [
            'company_id' => ['required', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($admin->id)],
            'password' => ['nullable', 'string', new Password],
        ])->validate();

        $input['password'] = $input['password'] ? Hash::make($input['password']) : $admin->password;

        $admin->update($input);
    }
}
