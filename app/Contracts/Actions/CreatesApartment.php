<?php

namespace App\Contracts\Actions;

use App\Models\Apartment;
use App\Models\Building;

interface CreatesApartment
{
    public function __invoke(Building $building, array $input): void;
}