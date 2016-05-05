<?php
/**
 * PublisherTrait.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/5 0005 14:52
 */

namespace App\Components\ContentManagementSystem\Content;


trait PublisherTrait
{
    public function contents()
    {
        return $this->morphMany(Content::class, 'publisher');
    }
}