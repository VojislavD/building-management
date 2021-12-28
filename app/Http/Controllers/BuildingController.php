<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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

    public function show(Building $building)
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

    public function destroy(Building $building)
    {
        if ($building->delete()) {
            return redirect()->to(route('buildings.index'))->with('buildingDeleted', __('Building is successfully deleted.'));
        } else {
            return redirect()->to(route('buildings.index'))->with('buildingNotDeleted', __('Oops! Something went wrong, please try again.'));
        }
    }
}
