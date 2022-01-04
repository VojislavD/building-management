<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        return view('apartments.index');
    }
    
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

    public function destroy(Apartment $apartment)
    {
        $building = $apartment->building;

        if ($apartment->delete()) {
            return redirect()->to(route('buildings.show', $building))->with('apartmentDeleted', 'Apartment successfully deleted.');
        } else {
            return redirect()->to(route('buildings.show', $building))->with('apartmentNotDeleted', 'Oops! Something went wrong, please try again.');
        }
    }
}
