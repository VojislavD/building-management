<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
