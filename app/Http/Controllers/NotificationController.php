<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;

class NotificationController extends Controller
{
    public function create(Building $building): Renderable
    {
        return view('notifications.create', [
            'building' => $building
        ]);
    }
}
