<?php

namespace App\Actions\Notifications;

use App\Contracts\Actions\CreatesNotification;
use App\Enums\NotificationStatus;
use App\Models\Building;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNotification implements CreatesNotification
{
    public function __invoke(Building $building, array $input): void
    {
        Validator::make($input, [
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'via_email' => ['accepted'],
            'scheduled_date' => [
                Rule::requiredIf(function () use ($input) {
                    return $input['send_scheduled'];
                }),
                'nullable',
                'date',
            ],
            'scheduled_time' => [
                Rule::requiredIf(function () use ($input) {
                    return $input['send_scheduled'];
                }),
                'nullable',
                'date_format:H:i',
            ],
        ])->validate();

        if ($input['send_scheduled']) {
            $send_at = Carbon::createFromFormat('Y-m-d H:i', $input['scheduled_date'].' '.$input['scheduled_time']);
        } else {
            $send_at = now();
        }

        Notification::create([
            'building_id' => $building->id,
            'status' => NotificationStatus::Scheduled(),
            'via_email' => $input['via_email'],
            'subject' => $input['subject'],
            'body' => $input['body'],
            'send_at' => $send_at,
        ]);
    }
}
