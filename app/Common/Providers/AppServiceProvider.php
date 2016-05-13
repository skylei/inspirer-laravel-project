<?php

namespace App\Common\Providers;

use App\Components\Inspirer\Http\ApiHandle;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ApiHandle::codeMap([
            '000000' => 200,
            '100000' => 400,
            '900000' => 500,
        ]);

        ApiHandle::apiMessages([
            '000000' => 'success',
            '100000' => 'request-or-operate-error',
            '900000' => 'unknown-error',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
