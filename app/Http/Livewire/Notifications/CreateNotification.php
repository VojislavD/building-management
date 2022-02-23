<?php

namespace App\Http\Livewire\Notifications;

use App\Contracts\Actions\CreatesNotification;
use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateNotification extends Component
{
    public Building $building;
    
    public $state = [];

    protected $messages = [
        'via_email.accepted' => 'One of channels for sending notification must be selected.',
    ];

    public function mount()
    {
        $this->fill([
            'state.internal_code' => $this->building->internal_code,
            'state.address' => $this->building->address,
            'state.via_email' => false,
            'state.send_immediately' => 'on',
            'state.send_scheduled' => false
        ]);
    }

    public function sendImmediately()
    {
        $this->state['send_scheduled'] = false;
    }

    public function sendScheduled()
    {
        $this->state['send_immediately'] = false;
    }

    public function submit(CreatesNotification $creator): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $creator($this->building, $this->state);

        session()->flash('notificationCreated', __('New notification successfully created.'));

        return to_route('buildings.show', $this->building);
    }

    public function render(): Renderable
    {
        return view('livewire.notifications.create-notification');
    }
}
