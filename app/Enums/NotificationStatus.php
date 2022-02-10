<?php

namespace App\Enums;

enum NotificationStatus: int 
{
    case Scheduled = 1;
    case Processing = 2;
    case Finished = 3;
    case Cancelled = 4;
}
