<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Building;
use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class AllNotificationsTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $status;
    public $building_id;

    public function updatingStatus() 
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage() 
    {
        $this->gotoPage(1);
    }

    public function updatingBuildingId() 
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        $notifications = Notification::query()
            ->when($this->status, function($query) {
                return $query->where('status', $this->status);
            })
            ->when($this->building_id, function($query) {
                return $query->where('building_id', $this->building_id);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.notifications.all-notifications-table', [
            'buildings' => Building::all(),
            'notifications' => $notifications
        ]);
    }
}
