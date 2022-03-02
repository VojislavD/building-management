<?php

namespace App\Contracts\Actions;

use App\Models\User;

interface UpdatesAdmin
{
    public function __invoke(User $admin, array $input): void;
}