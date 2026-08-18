<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;

// BACKUPS BASE DE DATOS
Schedule::command('backup:database')
    ->dailyAt('18:00');
// Schedule::command('backup:database')
//     ->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
