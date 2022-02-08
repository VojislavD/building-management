<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create(Building $building)
    {
        return view('notifications.create', [
            'building' => $building
        ]);
    }
}
