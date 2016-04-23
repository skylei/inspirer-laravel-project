<?php

namespace App\Components\UserSystem\AdministratorModules;

use App\Components\UserSystem\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AdminGroup
 *
 * @package App\Components\UserSystem\AdministratorModules
 */
class AdminGroup extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administrators()
    {
        return $this->hasMany(Administrator::class, 'group_id', 'id');
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
     * @param $displayName
     *
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->display_name = $displayName;
        
        return $this;
    }

    /**
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
}
