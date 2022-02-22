<?php

namespace App\Providers;

use App\Actions\Apartments\DeleteApartment;
use App\Contracts\Actions\DeletesApartment;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        DeletesApartment::class => DeleteApartment::class,
    ];
}
