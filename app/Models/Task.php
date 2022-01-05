<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_FINISHED = 2;
    const STATUS_REJECTED = 3;

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
