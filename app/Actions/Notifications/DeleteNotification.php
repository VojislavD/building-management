<?php

namespace App\Actions\Notifications;

use App\Contracts\Actions\DeletesNotification;
use App\Models\Notification;

class DeleteNotification implements DeletesNotification
{
    public function __invoke(Notification $notification): void
    {
        $notification->delete();
    }
}
