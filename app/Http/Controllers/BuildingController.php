<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        return view('buildings.index');
    }
}
