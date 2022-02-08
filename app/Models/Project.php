<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_FINISHED = 3;
    const STATUS_CANCELLED = 4;

    protected $casts = [
        'start_paying' => 'datetime',
        'end_paying' => 'datetime'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function getStatusLabel()
    {
        switch ($this->status) {
            case static::STATUS_PENDING:
                return '<span class="text-xs bg-yellow-600 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Pending") .'</span>';
                break;
            case static::STATUS_PROCESSING:
                return '<span class="text-xs bg-blue-600 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Processing") .'</span>';
                break;
            case static::STATUS_FINISHED:
                return '<span class="text-xs bg-green-600 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Finished") .'</span>';
                break;
            case static::STATUS_CANCELLED:
                return '<span class="text-xs bg-red-600 text-gray-100 px-2 py-0.5 rounded-lg capitalize">'. __("Cancelled") .'</span>';
                break;
            default:
                return __('N/A');
                break;
        }
    }
}
