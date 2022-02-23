<?php

namespace App\Providers;

use App\Actions\Apartments\CreateApartment;
use App\Actions\Apartments\DeleteApartment;
use App\Actions\Apartments\EditApartment;
use App\Actions\Buildings\CreateBuilding;
use App\Actions\Buildings\DeleteBuilding;
use App\Actions\Notifications\DeleteNotification;
use App\Actions\Projects\DeleteProject;
use App\Contracts\Actions\CreatesApartment;
use App\Contracts\Actions\CreatesBuilding;
use App\Contracts\Actions\DeletesApartment;
use App\Contracts\Actions\DeletesBuilding;
use App\Contracts\Actions\DeletesNotification;
use App\Contracts\Actions\DeletesProject;
use App\Contracts\Actions\EditsApartment;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        CreatesApartment::class => CreateApartment::class,
        EditsApartment::class => EditApartment::class,
        DeletesApartment::class => DeleteApartment::class,
        CreatesBuilding::class => CreateBuilding::class,
        DeletesBuilding::class => DeleteBuilding::class,
        DeletesNotification::class => DeleteNotification::class,
        DeletesProject::class => DeleteProject::class
    ];
}
