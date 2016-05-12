<?php
/**
 * SetRequestForConsole.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/12 0012 16:17
 */

namespace App\Console\Bootstraps;

use App\Components\Inspirer\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\SetRequestForConsole as LaravelBootstrap;

class SetRequestForConsole extends LaravelBootstrap
{
    public function bootstrap(Application $app)
    {
        $url = $app->make('config')->get('app.url', 'http://localhost');

        $app->instance('request', Request::create($url, 'GET', [], [], [], $_SERVER));
    }

}