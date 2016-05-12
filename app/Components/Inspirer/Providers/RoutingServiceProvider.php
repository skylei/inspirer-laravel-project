<?php
/**
 * RoutingServiceProvider.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/12 0012 18:52
 */

namespace App\Components\Inspirer\Providers;

use App\Components\Inspirer\Http\ApiHandle;
use App\Components\Inspirer\Http\ResponseFactory;
use Illuminate\Routing\RoutingServiceProvider as ServiceProvider;

class RoutingServiceProvider extends ServiceProvider
{
    protected function registerResponseFactory()
    {
        $this->app->singleton('Illuminate\Contracts\Routing\ResponseFactory', function ($app) {
            return new ResponseFactory($app['Illuminate\Contracts\View\Factory'], $app['redirect'], new ApiHandle());
        });
    }

}