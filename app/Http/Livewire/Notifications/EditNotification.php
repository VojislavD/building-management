<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Carbon\Carbon;
use Livewire\Component;

class EditNotification extends Component
{
    public Notification $notification;
    public $internal_code;
    public $address;
    public $status;
    public $subject;
    public $body;
    public $via_email;
    public $scheduled_date;
    public $scheduled_time;

    public function mount()
    {
        $this->internal_code = $this->notification->building->internal_code;    
        $this->address = $this->notification->building->address;
        $this->status = $this->notification->status->value;
        $this->subject = $this->notification->subject;
        $this->body = $this->notification->body;
        $this->via_email = $this->notification->via_email;
        $this->scheduled_date = Carbon::parse($this->notification->send_at)->toDateString();
        $this->scheduled_time = Carbon::parse($this->notification->send_at)->toTimeString();
    }

    public function render()
    {
        return view('livewire.notifications.edit-notification');
    }
}
