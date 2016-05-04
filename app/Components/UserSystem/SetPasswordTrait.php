<?php
/**
 * SetPasswordTrait.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/24 0:52
 */

namespace App\Components\UserSystem;


/**
 * Class SetPasswordTrait
 *
 * @package App\Components\UserSystem
 */
trait SetPasswordTrait
{
    /**
     * @param $password
     *
     * @return $this
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
        
        return $this;
    }

    /**
     * @param $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        
        return $this;
    }
}