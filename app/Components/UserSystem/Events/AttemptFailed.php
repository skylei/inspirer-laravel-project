<?php
/**
 * LoginError.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/6 0006 17:23
 */

namespace App\Components\UserSystem\Events;


use App\Components\UserSystem\Contracts\UserModel;

class AttemptFailed
{
    public $credentials;

    public $login;

    public $name;

    /**
     * @var UserModel
     */
    public $user;

    /**
     * AttemptFailed constructor.
     *
     * @param $credentials
     * @param $name
     * @param $user
     * @param $login
     */
    public function __construct($credentials, $name, $user, $login)
    {
        $this->name        = $name;
        $this->credentials = $credentials;
        $this->user        = $user;
        $this->login       = $login;
    }


}