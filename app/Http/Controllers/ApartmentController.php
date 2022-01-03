<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function create(Building $building)
    {
        return view('apartments.create', [
            'building' => $building
        ]);
    }

    public function edit(Apartment $apartment)
    {
        return view('apartments.edit', [
            'apartment' => $apartment
        ]);
    }
}
