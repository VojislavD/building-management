<?php

namespace App\Http\Livewire\Notifications;

use App\Contracts\Actions\CreatesNotification;
use App\Models\Building;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class CreateNotification extends Component
{
    public Building $building;

    public array $state = [];

    protected array $messages = [
        'via_email.accepted' => 'One of channels for sending notification must be selected.',
    ];

    public function mount(): void
    {
        $this->fill([
            'state.internal_code' => $this->building->internal_code,
            'state.address' => $this->building->address,
            'state.via_email' => false,
            'state.send_immediately' => 'on',
            'state.send_scheduled' => false,
        ]);
    }

    public function sendImmediately(): void
    {
        $this->state['send_scheduled'] = false;
    }

    public function sendScheduled(): void
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
