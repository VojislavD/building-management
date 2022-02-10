<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'building_id', 
        'user_id', 
        'number', 
        'tenants'
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
