<?php

namespace App\Providers;

use App\Services\TwilioService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TwilioService::class, function ($app) {
            return new TwilioService();
        });
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    Gate::define('admin', function ($user) {
        return $user->hasRole('Administrador')
            || $user->hasRole('SuperAdministrador');
    });

    Gate::define('admin1', function ($user) {
        return $user->hasRole('Administrador');
    });

    Gate::define('superadministrador', function ($user) {
        return $user->hasRole('SuperAdministrador');
    });

    Gate::define('usuario', function ($user) {
        return $user->hasRole('Usuario');
    });

    Gate::define('tecnico', function ($user) {
        return $user->hasRole('Tecnico');
    });

        Gate::define('gestion-equipos', function ($user) {

        // Administrador puede acceder
        if ($user->hasRole('Administrador')) {
            return true;
        }

        // Técnico únicamente de SOPORTE
        return $user->hasRole('Tecnico')
            && $user->especialidad?->codigo === 'SOPORTE';
    });

    Gate::define('mis-asignaciones-soporte', function ($user) {
    return $user->hasRole('Tecnico')
        && $user->especialidad?->codigo === 'SOPORTE';
});
}


}
