<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

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

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
}
