<?php

namespace App\Components\Inspirer\Providers;

use Illuminate\Console\ScheduleServiceProvider;
use Illuminate\Database\MigrationServiceProvider;
use Illuminate\Database\SeedServiceProvider;
use Illuminate\Foundation\Providers\ComposerServiceProvider;
use Illuminate\Queue\ConsoleServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider as LaravelProvider;

class ConsoleSupportServiceProvider extends LaravelProvider
{
    protected $providers = [
        ArtisanServiceProvider::class,
        ScheduleServiceProvider::class,
        MigrationServiceProvider::class,
        SeedServiceProvider::class,
        ComposerServiceProvider::class,
        ConsoleServiceProvider::class,
    ];
}
