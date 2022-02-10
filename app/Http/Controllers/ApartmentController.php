<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class ApartmentController extends Controller
{
    public function index(): Renderable
    {
        return view('apartments.index');
    }
    
    public function create(Building $building): Renderable
    {
        return view('apartments.create', [
            'building' => $building
        ]);
    }

    public function edit(Apartment $apartment): Renderable
    {
        return view('apartments.edit', [
            'apartment' => $apartment
        ]);
    }

    public function destroy(Apartment $apartment): RedirectResponse
    {
        $building = $apartment->building;

        if ($apartment->delete()) {
            return redirect()->to(route('buildings.show', $building))->with('apartmentDeleted', 'Apartment successfully deleted.');
        } else {
            return redirect()->to(route('buildings.show', $building))->with('apartmentNotDeleted', 'Oops! Something went wrong, please try again.');
        }
    }
}
