<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELLED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'status', 
        'comment'
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function getLimitedDescriptionAttribute(): string
    {
        return Str::limit($this->description, 40, '...');
    }

    public function getStatusLabel(): string
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
