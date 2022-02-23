<?php

namespace App\Contracts\Actions;

use App\Models\Apartment;

interface EditsApartment
{
    public function __invoke(Apartment $apartment, array $input): void;
}