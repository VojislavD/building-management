<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Building;
use App\Models\Notification;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationsTableForBuilding extends Component
{
    use WithPagination;
    
    public Building $building;
    public int|null $status = null;

    public function render(): Renderable
    {
        $notifications = Notification::where('building_id', $this->building->id)
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.notifications.notifications-table-for-building', [
            'notifications' => $notifications
        ]);
    }
}
