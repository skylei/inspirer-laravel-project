<?php

namespace App\Components\UserSystem;

use App\Components\ContentManagementSystem\Content\PublisherTrait;
use App\Components\UserSystem\Contracts\UserModel;
use App\Components\UserSystem\Events\AttemptFailed;
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
    use SoftDeletes, SetPasswordTrait, PublisherTrait;
    
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
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function afterLogin(Login $login)
    {
        $this->increment('login_times');
        $this->last_login = new \DateTime();
        $this->save();
    }

    public function afterLogout(Logout $logout)
    {
        // 
    }

    public function attemptFailed(AttemptFailed $failed)
    {
        //
    }

    public function getUserAccount()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }
}
