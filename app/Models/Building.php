<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'company_id', 
        'internal_code', 
        'status', 
        'construction_year', 
        'square', 
        'floors', 
        'apartments', 
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

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
    
    public function scopeActive()
    {
        $this->where('status', static::STATUS_ACTIVE);
    }

    public function scopeInactive()
    {
        $this->where('status', static::STATUS_INACTIVE);
    }

    public function allTenants(): Collection
    {
        $apartments = $this->apartments();

        $tenants = collect();

        $apartments->each(function ($item) use ($tenants) {
            $tenants->push($item->owner);
        });

        return $tenants;
    }

    public function tenantsSum(): int
    {
        return $this->apartments->sum('tenants');
    }

    public static function availableConstructionYears(): array
    {
        $years = [];

        for ($i = now()->year; $i >= 1950; $i--) {
            $years[$i] = $i;
        }

        return $years;
    }

    public function getStatusText(): string
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

    public function getStatusLabel(): string
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

    public function getElevatorStatusText(): string
    {
        if ($this->elevator) {
            return __('Yes');
        } else {
            return __('No');
        }
    }

    public function getYardStatusText(): string
    {
        if ($this->yard) {
            return __('Yes');
        } else {
            return __('No');
        }
    }
}
