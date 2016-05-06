<?php
/**
 * UserSystemProvider.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/30 0:43
 */

namespace App\Components\UserSystem;


use App\Components\UserSystem\Contracts\UserModel;
use App\Components\UserSystem\Events\AttemptFailed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class UserSystemProvider extends ServiceProvider
{
    public function boot(Dispatcher $events)
    {
        Relation::morphMap([
            'UserSystem\User'          => User::class,
            'UserSystem\Administrator' => Administrator::class,
        ]);

        $this->app->make('auth')->extend('inspirer-session', function ($app, $name, array $config) {
            $inspirerSessionGuard = new InspirerSessionGuard(
                $name,
                $app->make('auth')->createUserProvider($config['provider']),
                $app['session.store']
            );

            $inspirerSessionGuard->setDispatcher($app['events']);
            $inspirerSessionGuard->setCookieJar($app['cookie']);
            $inspirerSessionGuard->setRequest($app->refresh('request', $inspirerSessionGuard, 'setRequest'));

            return $inspirerSessionGuard;
        });

        $events->listen(Login::class, function (Login $login) {
            if ($login->user instanceof UserModel) {
                $login->user->afterLogin($login);
            }
        });

        $events->listen(Logout::class, function (Logout $logout) {
            if ($logout->user instanceof UserModel) {
                $logout->user->afterLogout($logout);
            }
        });

        $events->listen(AttemptFailed::class, function (AttemptFailed $attemptFailed) {
            if ($attemptFailed->user instanceof UserModel) {
                $attemptFailed->user->attemptFailed($attemptFailed);
            }
        });
    }

    public function register()
    {
        //
    }

}