<?php

namespace App\Components\UserSystem;

use App\Components\UserSystem\Contracts\UserModel;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App\Components\UserSystem
 */
class User extends Authenticatable implements UserModel
{
    use SoftDeletes, SetPasswordTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function afterLogin(Login $login)
    {

    }

    public function afterLogout(Logout $logout)
    {
        
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }
}
