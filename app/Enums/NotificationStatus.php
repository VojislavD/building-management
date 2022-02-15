<?php

namespace App\Enums;

enum NotificationStatus: int 
{
    case Scheduled = 1;
    case Processing = 2;
    case Finished = 3;
    case Cancelled = 4;

    public function label(): string
    {
        return match($this)
        {
            NotificationStatus::Scheduled => '<span class="text-xs bg-yellow-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Scheduled") .'</span>',
            NotificationStatus::Processing => '<span class="text-xs bg-blue-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Processing") .'</span>',
            NotificationStatus::Finished => '<span class="text-xs bg-green-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Finished") .'</span>',
            NotificationStatus::Cancelled => '<span class="text-xs bg-red-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Cancelled") .'</span>',
            default => __('N/A')
        };
    }
}
