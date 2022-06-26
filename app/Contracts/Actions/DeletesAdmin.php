<?php

namespace App\Contracts\Actions;

use App\Models\User;

interface DeletesAdmin
{
    public function __invoke(User $admin): void;
}
