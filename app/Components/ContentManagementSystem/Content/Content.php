<?php
/**
 * Content.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/4 0004 14:31
 */

namespace App\Components\ContentManagementSystem\Content;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    public function contentModel()
    {
        return $this->morphTo('content_model', 'content_model_type', 'content_model_id');
    }

    public function node()
    {
        return $this->morphTo();
    }
}