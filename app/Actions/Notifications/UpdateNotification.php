<?php

namespace App\Actions\Notifications;

use App\Contracts\Actions\UpdatesNotification;
use App\Enums\NotificationStatus;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateNotification implements UpdatesNotification
{
    public function __invoke(Notification $notification, array $input): void
    {
        if (array_key_first($input) === 'status') {
            Validator::make($input, [
                'status' => ['required', Rule::in([
                    NotificationStatus::Scheduled(),
                    NotificationStatus::Processing(),
                    NotificationStatus::Finished(),
                    NotificationStatus::Cancelled(),
                ])],
            ])->validate();

            $notification->update(['status' => $input['status']]);
        }
    }
}
