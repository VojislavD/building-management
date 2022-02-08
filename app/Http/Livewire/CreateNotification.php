<?php

namespace App\Http\Livewire;

use App\Models\Building;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateNotification extends Component
{
    public Building $building;
    public $internal_code;
    public $address;
    public $subject;
    public $body;
    public $via_email  = false;
    public $send_immediately = 'on';
    public $send_scheduled = false;
    public $scheduled_date;
    public $scheduled_time;

    protected $messages = [
        'via_email.accepted' => 'One of channels for sending notification must be selected.',
    ];

    public function mount()
    {
        $this->internal_code = $this->building->internal_code;
        $this->address = $this->building->address;
    }

    protected function rules()
    {
        return [
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'via_email' => ['accepted', 'boolean'],
            'scheduled_date' => [
                Rule::requiredIf(function () { 
                    return $this->send_scheduled ? true : false; 
                }), 
                'nullable', 
                'date', 
            ],
            'scheduled_time' => [
                Rule::requiredIf(function () { 
                    return $this->send_scheduled ? true : false; 
                }), 
                'nullable', 
                'date_format:H:i',
            ]
        ];
    }

    public function sendImmediately()
    {
        dd($this->via_email);
        $this->send_scheduled = false;
    }

    public function sendScheduled()
    {
        $this->send_immediately = false;
    }

    public function submit()
    {
        $this->validate();

        if ($this->send_scheduled) {
            $send_at = Carbon::createFromFormat('Y-m-d H:i', $this->scheduled_date.' '.$this->scheduled_time);
        } else {
            $send_at = now();
        }
        
        $newNotification = Notification::create([
            'building_id' => $this->building->id,
            'status' => Notification::STATUS_SCHEDULED,
            'via_email' => $this->via_email,
            'subject' => $this->subject,
            'body' => $this->body,
            'send_at' => $send_at
        ]);
        
        if ($newNotification instanceof Notification) {
            session()->flash('notificationCreated', __('New notification successfully created.'));
        } else {
            session()->flash('notificationNotCreated', __('Oops! Something went wrong, please try again.'));
        }

        return redirect()->to(route('buildings.show', $this->building));
    }

    public function render()
    {
        return view('livewire.create-notification');
    }
}
