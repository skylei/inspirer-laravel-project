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
}