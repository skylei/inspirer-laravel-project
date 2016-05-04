<?php
/**
 * ContentManagementSystemProvider.php
 *
 * Creator:    chongyi
 * Created at: 2016/5/4 0004 16:16
 */

namespace App\Components\ContentManagementSystem;


use App\Components\ContentManagementSystem\Content\ContentModels\Article;
use App\Components\ContentManagementSystem\Node\Index\ContentCategory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class ContentManagementSystemProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            Article::class => 'Article',

            ContentCategory::class => 'ArticleCategory',
        ]);
    }
    
    public function register()
    {
        //
    }

}