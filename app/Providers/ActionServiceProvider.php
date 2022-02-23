<?php

namespace App\Providers;

use App\Actions\Apartments\CreateApartment;
use App\Actions\Apartments\DeleteApartment;
use App\Actions\Apartments\UpdateApartment;
use App\Actions\Buildings\CreateBuilding;
use App\Actions\Buildings\DeleteBuilding;
use App\Actions\Buildings\UpdateBuilding;
use App\Actions\Notifications\DeleteNotification;
use App\Actions\Projects\DeleteProject;
use App\Actions\Projects\UpdateProject;
use App\Contracts\Actions\CreatesApartment;
use App\Contracts\Actions\CreatesBuilding;
use App\Contracts\Actions\DeletesApartment;
use App\Contracts\Actions\DeletesBuilding;
use App\Contracts\Actions\DeletesNotification;
use App\Contracts\Actions\DeletesProject;
use App\Contracts\Actions\UpdatesApartment;
use App\Contracts\Actions\UpdatesBuilding;
use App\Contracts\Actions\UpdatesProject;
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
        UpdatesApartment::class => UpdateApartment::class,
        DeletesApartment::class => DeleteApartment::class,
        CreatesBuilding::class => CreateBuilding::class,
        UpdatesBuilding::class => UpdateBuilding::class,
        DeletesBuilding::class => DeleteBuilding::class,
        DeletesNotification::class => DeleteNotification::class,
        UpdatesProject::class => UpdateProject::class,
        DeletesProject::class => DeleteProject::class
    ];
}
