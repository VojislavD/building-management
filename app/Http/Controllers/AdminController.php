<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(): Renderable
    {
        return view('admins.index');
    }

    public function create(): Renderable
    {
        return view('admins.create');
    }
}
