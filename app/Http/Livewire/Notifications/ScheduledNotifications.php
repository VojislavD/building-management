<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduledNotifications extends Component
{
    use WithPagination;

    public function render(): Renderable
    {
        $notifications = Notification::scheduled()
            ->latest()
            ->paginate(5, ['*'], 'notificationsPage');

        return view('livewire.notifications.scheduled-notifications', [
            'notifications' => $notifications,
        ]);
    }
}
