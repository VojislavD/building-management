<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class PendingNotifications extends Component
{
    use WithPagination;
    
    public function render()
    {
        $scheduledNotifications = Notification::scheduled()
            ->latest()
            ->paginate(5);

        return view('livewire.notifications.pending-notifications', [
            'scheduledNotifications' => $scheduledNotifications
        ]);
    }
}
