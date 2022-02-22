<?php

namespace App\Contracts\Actions;

use App\Models\Apartment;

interface DeletesApartment
{
    public function __invoke(Apartment $apartment): void;
}