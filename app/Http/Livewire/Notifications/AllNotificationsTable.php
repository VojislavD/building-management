<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Building;
use App\Models\Notification;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;
use Livewire\WithPagination;

class AllNotificationsTable extends Component
{
    use WithPagination;

    public int $perPage = 10;
    public int|null $status = null;
    public int|null $building_id = null;

    public function updatingStatus(): void
    {
        $this->gotoPage(1);
    }

    public function updatingPerPage(): void
    {
        $this->gotoPage(1);
    }

    public function updatingBuildingId(): void
    {
        $this->gotoPage(1);
    }

    public function render(): Renderable
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
