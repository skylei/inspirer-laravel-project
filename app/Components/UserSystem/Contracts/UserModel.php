<?php
/**
 * UserModel.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/30 1:00
 */

namespace App\Components\UserSystem\Contracts;


use App\Components\UserSystem\Events\AttemptFailed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

/**
 * Interface UserModel
 *
 * @package App\Components\UserSystem\Contracts
 */
interface UserModel
{
    /**
     * @param Login $login
     *
     * @return mixed
     */
    public function afterLogin(Login $login);

    /**
     * @param Logout $logout
     *
     * @return mixed
     */
    public function afterLogout(Logout $logout);

    /**
     * @param AttemptFailed $failed
     *
     * @return mixed
     */
    public function attemptFailed(AttemptFailed $failed);

    /**
     * 获取用户用于标识的账号
     * 
     * @return mixed
     */
    public function getUserAccount();
}