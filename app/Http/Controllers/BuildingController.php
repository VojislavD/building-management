<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\DeletesBuilding;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class BuildingController extends Controller
{
    public function index(): Renderable
    {
        return view('buildings.index');
    }

    public function create(): Renderable
    {
        return view('buildings.create');
    }

    public function show(Building $building): Renderable
    {
        return view('buildings.show', [
            'building' => $building
        ]);
    }

    public function edit(Building $building): Renderable
    {
        return view('buildings.edit', [
            'building' => $building
        ]);
    }

    public function destroy(Building $building, DeletesBuilding $deletesBuilding): RedirectResponse
    {
        $deletesBuilding($building);

        return to_route('buildings.index')->with('buildingDeleted', __('Building is successfully deleted.'));
    }
}
