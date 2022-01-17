<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    protected $fillable = [
        'company_id', 
        'internal_code', 
        'status', 
        'construction_year', 
        'square', 
        'floors', 
        'apartments', 
        'tenants', 
        'elevator', 
        'yard', 
        'balance', 
        'balance_begining', 
        'pib', 
        'identification_number', 
        'account_number', 
        'address', 
        'city', 
        'county', 
        'postal_code', 
        'comment'
    ];

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
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

    public function getStatusText()
    {
        switch ($this->status) {
            case static::STATUS_ACTIVE:
                return __("Active");
                break;
            case static::STATUS_INACTIVE:
                return __("Inactive");
                break;
            default:
                return __('N/A');
                break;
        }
    }

    public function getStatusLabel()
    {
        switch ($this->status) {
            case static::STATUS_ACTIVE:
                return '<span class="text-xs bg-green-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Active") .'</span>';
                break;
            case static::STATUS_INACTIVE:
                return '<span class="text-xs bg-red-600 text-gray-100 lowercase px-2 py-0.5 rounded-lg">'. __("Inactive") .'</span>';
                break;
            default:
                return __('N/A');
                break;
        }
    }

    public function getElevatorStatusText()
    {
        if ($this->elevator) {
            return __('Yes');
        } else {
            return __('No');
        }
    }

    public function getYardStatusText()
    {
        if ($this->yard) {
            return __('Yes');
        } else {
            return __('No');
        }
    }
}
