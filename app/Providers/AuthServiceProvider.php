<?php

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Facades\Auth;

Auth::provider('users', function ($app, array $config) {
    return new EloquentUserProvider($app['hash'], $config['model'], function ($query) {
        $query->where('estado_usuarios', 1);
    });
});
?>
