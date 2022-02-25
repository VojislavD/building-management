<?php

namespace App\Models;

use App\Enums\BuildingStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => BuildingStatus::class,
    ];

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
    
    public function scopeActive(): Builder
    {
        return $this->where('status', static::STATUS_ACTIVE);
    }

    public function scopeInactive(): Builder
    {
        return $this->where('status', static::STATUS_INACTIVE);
    }

    public function allTenants(): Collection
    {
        $apartments = $this->apartments();

        $tenants = new Collection();

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

    public function elevatorStatusText(): Attribute
    {
        return new Attribute(
            get: fn() => $this->elevator ? __('Yes') : __('No')
        );
    }

    public function yardStatusText(): Attribute
    {
        return new Attribute(
            get: fn() => $this->yard ? __('Yes') : __('No')
        );
    }
}
