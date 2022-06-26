<?php

namespace App\Contracts\Actions;

use App\Models\Building;

interface CreatesNotification
{
    public function __invoke(Building $building, array $input): void;
}
