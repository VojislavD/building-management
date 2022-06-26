<?php

namespace App\Contracts\Actions;

use App\Models\Notification;

interface DeletesNotification
{
    public function __invoke(Notification $notification): void;
}
