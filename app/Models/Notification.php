<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const STATUS_SCHEDULED = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_FINISHED = 3;
    const STATUS_CANCELLED = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'building_id',
        'status',
        'via_email',
        'subject',
        'body',
        'send_at'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
