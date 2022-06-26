<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\DeletesApartment;
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
            'building' => $building,
        ]);
    }

    public function edit(Apartment $apartment): Renderable
    {
        return view('apartments.edit', [
            'apartment' => $apartment,
        ]);
    }

    public function destroy(Apartment $apartment, DeletesApartment $deleter): RedirectResponse
    {
        $deleter($apartment);

        return to_route('buildings.show', $apartment->building)->with('apartmentDeleted', 'Apartment successfully deleted.');
    }
}
