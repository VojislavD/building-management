<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'status',
        'name',
        'price',
        'rates',
        'amount_payed',
        'amount_left',
        'start_paying',
        'end_paying',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => ProjectStatus::class,
        'start_paying' => 'datetime',
        'end_paying' => 'datetime',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function scopeActive(): Builder
    {
        return $this->whereIn('status', [ProjectStatus::Pending, ProjectStatus::Processing]);
    }
}
