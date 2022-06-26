<?php

namespace App\Contracts\Actions;

use App\Models\Building;

interface DeletesBuilding
{
    public function __invoke(Building $building): void;
}
