<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELLED = 3;

    protected $fillable = ['status'];
    
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function getStatusLabel()
    {
        switch ($this->status) {
            case static::STATUS_PENDING:
                return '<span class="text-xs bg-yellow-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Pending") .'</span>';
                break;
            case static::STATUS_COMPLETED:
                return '<span class="text-xs bg-green-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Finished") .'</span>';
                break;
            case static::STATUS_CANCELLED:
                    return '<span class="text-xs bg-red-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Cancelled") .'</span>';
                    break;
            default:
                return __('N/A');
                break;
        }
    }
}
