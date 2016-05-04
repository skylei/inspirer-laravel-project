<?php
/**
 * MorphRelationTrait.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/4 0004 14:33
 */

namespace App\Components\ContentManagementSystem\Content;


trait PolymorphicRelationTrait
{
    public function master()
    {
        return $this->morphOne(Content::class, 'content_model');
    }
}