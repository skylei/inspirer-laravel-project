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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTime;

/**
 * Class Article
 *
 * @package App\Components\ContentManagementSystem\Content\ContentModels
 */
class Article extends Model implements ContentModel
{
    use SoftDeletes, PolymorphicRelationTrait;

    /**
     * @var array
     */
    protected $dates = ['published_at', 'expired_at'];

    /**
     * @param $publishedAt
     *
     * @return Article
     */
    public function setPublishedAt($publishedAt)
    {
        $this->published_at = $publishedAt;

        return $this;
    }

    /**
     * @param $cover
     *
     * @return Article
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @param      $source
     * @param null $name
     *
     * @return Article
     */
    public function setSource($source, $name = null)
    {
        $this->source      = $source;
        $this->source_name = $name;

        return $this;
    }

    /**
     * @param $expiredAt
     *
     * @return Article
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expired_at = $expiredAt;

        return $this;
    }

    /**
     * @param $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param $name
     *
     * @return Article
     */
    public function setAuthor($name)
    {
        $this->author = $name;

        return $this;
    }

    public function scopePublished(Builder $builder, DateTime $published = null)
    {
        if (is_null($published)) {
            $published = new DateTime();
        }
        
        return $builder->where('published_at', '<=', $published);
    }

    public function scopeWithoutExpired(Builder $builder, DateTime $expired = null)
    {
        if (is_null($expired)) {
            $expired = new DateTime();
        }
        
        return $builder->where(function (Builder $builder) use ($expired) {
            $builder->where('expired_at', '>', $expired)->orWhereNull('expired_at');
        });
    }
}