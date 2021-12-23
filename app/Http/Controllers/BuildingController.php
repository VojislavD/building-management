<?php

namespace App\Http\Controllers;

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
}
