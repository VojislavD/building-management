<?php

namespace App\Actions\Admins;

use App\Contracts\Actions\DeletesAdmin;
use App\Models\User;

class DeleteAdmin implements DeletesAdmin
{
    public function __invoke(User $admin): void
    {
        $admin->delete();
    }
}
