<?php

namespace App\Components\UserSystem;

use App\Components\UserSystem\AdministratorModules\AdminGroup;
use App\Components\UserSystem\AdministratorModules\AdminOperationalLog;
use App\Components\UserSystem\Contracts\UserModel;
use App\Components\UserSystem\Events\AttemptFailed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * Class Administrator
 *
 * @package App\Components\UserSystem
 */
class Administrator extends Model implements AuthenticatableContract, AuthorizableContract, UserModel
{
    use SoftDeletes, Authenticatable, Authorizable, SetPasswordTrait;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email'];

    /**
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(AdminGroup::class, 'group_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function operationalLog()
    {
        return $this->hasMany(AdminOperationalLog::class, 'operator_id', 'id');
    }

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

    /**
     * @param $group
     *
     * @return $this
     */
    public function setGroup($group)
    {
        if ($group instanceof AdminGroup) {
            $this->group()->associate($group);
        } else {
            $group = AdminGroup::findOrFail($group);
            $this->group()->associate($group);
        }

        return $this;
    }

    public function afterLogin(Login $login)
    {
        $this->increment('login_times');
        $this->last_login = $date = new \DateTime();
        $this->save();

        (new AdminOperationalLog())->info(trans('messages.user-system.log.login'),
                                          [$this->name, $date->format('Y-m-d H:i:s')])->save();
    }

    public function afterLogout(Logout $logout)
    {
        //
    }

    public function getUserAccount()
    {
        return $this->name;
    }


    public function attemptFailed(AttemptFailed $failed)
    {
        (new AdminOperationalLog())->info(trans('messages.user-system.log.attempt-failed'),
            [$failed->user->getUserAccount(), (new \DateTime())->format('Y-m-d H:i:s')])->save();
    }
}
