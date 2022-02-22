<?php

namespace App\Actions\Apartments;

use App\Contracts\Actions\DeletesApartment;
use App\Models\Apartment;

class DeleteApartment implements DeletesApartment
{
    public function __invoke(Apartment $apartment): void
    {
        $apartment->delete();
    }
}