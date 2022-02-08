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
}
