<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    public function scopeActive()
    {
        return $this->where('status', static::STATUS_ACTIVE);
    }

    public function scopeInactive()
    {
        return $this->where('status', static::STATUS_INACTIVE);
    }

    public static function availableConstructionYears()
    {
        $years = [];

        for ($i = now()->year; $i >= 1950; $i--) {
            $years[$i] = $i;
        }

        return $years;
    }
}
