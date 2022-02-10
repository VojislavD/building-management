<?php

namespace App\Enums;

enum TaskStatus: int 
{
    case Pending = 1;
    case Completed = 2;
    case Cancelled = 3;

    public function label(): string
    {
        return match($this)
        {
            TaskStatus::Pending => '<span class="text-xs bg-yellow-500 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Pending") .'</span>',
            TaskStatus::Completed => '<span class="text-xs bg-green-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Finished") .'</span>',
            TaskStatus::Cancelled => '<span class="text-xs bg-red-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Cancelled") .'</span>',
            default => __('N/A')
        };
    }
}