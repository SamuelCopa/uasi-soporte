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

    // SuperAdministrador y Administrador
    if ($user->hasAnyRole([
        'SuperAdministrador',
        'Administrador'
    ])) {
        return true;
    }

    // Técnico únicamente de SOPORTE
    return $user->hasRole('Tecnico')
        && $user->especialidad?->codigo === 'SOPORTE';
});

Gate::define('mis-asignaciones-soporte', function ($user) {

    $user->loadMissing('especialidades');

    return $user->hasRole('Administrador')
        || (
            $user->hasRole('Tecnico')
            && $user->especialidades->contains('codigo', 'SOPORTE')
        );
});

Gate::define('registro-equipos', function ($user) {

    $user->loadMissing('especialidades');

    return $user->hasAnyRole([
        'Administrador',
        'SuperAdministrador'
    ])
    || (
        $user->hasRole('Tecnico')
        && $user->especialidades->contains('codigo', 'SOPORTE')
    );
});
}
}
