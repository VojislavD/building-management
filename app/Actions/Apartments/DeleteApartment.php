<?php

namespace App\Actions\Apartments;

use App\Models\Apartment;

class DeleteApartment
{
    public function handle(Apartment $apartment)
    {
        $apartment->delete();
    }
}