<?php
/**
 * AdminSessionGuard.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/6 0006 17:22
 */

namespace App\Components\UserSystem;


use Illuminate\Auth\SessionGuard;

/**
 * Class InspirerSessionGuard
 *
 * @package App\Components\UserSystem
 */
class InspirerSessionGuard extends SessionGuard
{
    /**
     * @param array $credentials
     * @param bool  $remember
     * @param bool  $login
     *
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false, $login = true)
    {
        $this->fireAttemptEvent($credentials, $remember, $login);

        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);
        
        if ($this->hasValidCredentials($user, $credentials)) {
            if ($login) {
                $this->login($user, $remember);
            }

            return true;
        }

        $this->fireAttemptFailedEvent($credentials, $this->name, $user, $login);
        
        return false;
    }

    /**
     * @param array $credentials
     * @param       $name
     * @param       $user
     * @param       $login
     */
    public function fireAttemptFailedEvent(array $credentials, $name, $user, $login)
    {
        if (isset($this->events)) {
            $this->events->fire(new Events\AttemptFailed($credentials, $name, $user, $login));
        }
    }
}