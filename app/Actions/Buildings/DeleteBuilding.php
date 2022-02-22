<?php

namespace App\Actions\Buildings;

use App\Contracts\Actions\DeletesBuilding;
use App\Models\Building;

class DeleteBuilding implements DeletesBuilding
{
    public function __invoke(Building $building): void
    {
        $building->delete();
    }
}