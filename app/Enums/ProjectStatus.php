<?php

namespace App\Enums;

enum ProjectStatus: int 
{
    case Pending = 1;
    case Processing = 2;
    case Finished = 3;
    case Cancelled = 4;

    public function label(): string
    {
        return match($this)
        {
            ProjectStatus::Pending => '<span class="text-xs bg-yellow-500 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Pending") .'</span>',
            ProjectStatus::Processing => '<span class="text-xs bg-blue-600 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Processing") .'</span>',
            ProjectStatus::Finished => '<span class="text-xs bg-green-600 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Finished") .'</span>',
            ProjectStatus::Cancelled => '<span class="text-xs bg-red-600 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Cancelled") .'</span>'
        };
    }
}