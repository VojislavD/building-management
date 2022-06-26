<?php

namespace App\Contracts\Actions;

use App\Models\Notification;

interface UpdatesNotification
{
    public function __invoke(Notification $notification, array $input): void;
}
