<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar Observers para notificações
        \App\Models\MissionaryField::observe(\App\Observers\MissionaryFieldObserver::class);
        \App\Models\VolunteerTeam::observe(\App\Observers\VolunteerTeamObserver::class);
    }
}
