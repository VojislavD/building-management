<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Building;
use App\Models\Notification;
use Livewire\Component;

class NotificationsTableForBuilding extends Component
{
    public Building $building;

    public function render()
    {
        $notifications = Notification::where('building_id', $this->building->id)
            ->paginate(10);

        return view('livewire.notifications.notifications-table-for-building', [
            'notifications' => $notifications
        ]);
    }
}
