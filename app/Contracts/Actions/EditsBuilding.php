<?php

namespace App\Contracts\Actions;

use App\Models\Building;

interface EditsBuilding
{
    public function __invoke(Building $building, array $input): void;
}