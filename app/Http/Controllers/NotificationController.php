<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\DeletesNotification;
use App\Contracts\Actions\UpdatesNotification;
use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function index(): Renderable
    {
        return view('notifications.index');
    }

    public function create(Building $building): Renderable
    {
        return view('notifications.create', [
            'building' => $building,
        ]);
    }

    public function show(Notification $notification): Renderable
    {
        return view('notifications.show', [
            'notification' => $notification,
        ]);
    }

    public function cancel(Notification $notification, UpdatesNotification $updater): RedirectResponse
    {
        $updater($notification, ['status' => NotificationStatus::Cancelled()]);

        return to_route('buildings.show', $notification->building)->with('notificationCancelled', __('Notification is successfully cancelled.'));
    }

    public function destroy(Notification $notification, DeletesNotification $deleter): RedirectResponse
    {
        $deleter($notification);

        return to_route('buildings.show', $notification->building)->with('notificationDeleted', __('Notification is successfully deleted.'));
    }
}
