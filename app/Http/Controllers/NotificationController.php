<?php

namespace App\Http\Controllers;

use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use Illuminate\Contracts\Support\Renderable;

class NotificationController extends Controller
{
    public function create(Building $building): Renderable
    {
        return view('notifications.create', [
            'building' => $building
        ]);
    }

    public function cancel(Notification $notification)
    {
        $notification->update([
            'status' => NotificationStatus::Cancelled->value
        ]);

        return to_route('buildings.show', $notification->building)->with('notificationCancelled', __('Notification is successfully cancelled.'));
    }

    public function destroy(Notification $notification)
    {
        if ($notification->delete()) {
            return to_route('buildings.show', $notification->building)->with('notificationDeleted', __('Notification is successfully deleted.'));
        } else {
            return to_route('buildings.show', $notification->building)->with('notificationNotDeleted', __('Oops! Something went wrong, please try again.'));
        }
    }
}
