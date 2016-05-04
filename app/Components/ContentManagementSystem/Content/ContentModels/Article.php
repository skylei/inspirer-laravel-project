<?php
/**
 * Article.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/4 0004 14:32
 */

namespace App\Components\ContentManagementSystem\Content\ContentModels;

use App\Components\ContentManagementSystem\Content\ContentModel;
use App\Components\ContentManagementSystem\Content\PolymorphicRelationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model implements ContentModel
{
    use SoftDeletes, PolymorphicRelationTrait;
}