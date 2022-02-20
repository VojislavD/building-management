<?php

namespace App\Enums;

enum BuildingStatus: int 
{
    use InvokableClass;
    
    case Active = 1;
    case Inactive = 2;

    public function name(): string
    {
        return match($this)
        {
            BuildingStatus::Active => __("Active"),
            BuildingStatus::Inactive => __("Inactive"),
            default => __('N/A')
        };
    }

    public function label(): string
    {
        return match($this)
        {
            BuildingStatus::Active => '<span class="text-xs bg-green-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Active") .'</span>',
            BuildingStatus::Inactive => '<span class="text-xs bg-red-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Inactive") .'</span>',
            default => __('N/A')
        };
    }
}