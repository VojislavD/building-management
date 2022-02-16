<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduledNotifications extends Component
{
    use WithPagination;

    public function render()
    {
        $scheduledNotifications = Notification::scheduled()
            ->latest()
            ->paginate(5);

        return view('livewire.notifications.scheduled-notifications', [
            'scheduledNotifications' => $scheduledNotifications
        ]);
    }
}
