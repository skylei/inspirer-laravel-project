<?php

namespace App\Components\UserSystem;

use App\Components\UserSystem\AdministratorModules\AdminGroup;
use App\Components\UserSystem\AdministratorModules\AdminOperationalLog;
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
class Administrator extends Model implements AuthenticatableContract, AuthorizableContract
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
}
