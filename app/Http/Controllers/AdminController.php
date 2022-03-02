<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function edit(User $user): Renderable
    {
        return view('admins.edit', [
            'admin' => $user
        ]);
    }
}
