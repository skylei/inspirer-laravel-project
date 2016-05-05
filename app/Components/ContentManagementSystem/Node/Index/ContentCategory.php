<?php
/**
 * Node.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/4 0004 16:47
 */

namespace App\Components\ContentManagementSystem\Node\Index;


use App\Components\ContentManagementSystem\Content\Content;
use Illuminate\Database\Eloquent\Model;

class ContentCategory extends Model
{
    public function contents()
    {
        return $this->morphMany(Content::class, 'node');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}