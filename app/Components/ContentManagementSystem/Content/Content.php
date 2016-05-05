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
use Closure;

class Content extends Model
{
    use SoftDeletes;

    /**
     * @var ContentModel|Model
     */
    protected $modelInstance;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contentModel()
    {
        return $this->morphTo('content_model', 'content_model_type', 'content_model_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function publisher()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function node()
    {
        return $this->morphTo();
    }

    /**
     * @param string $title
     *
     * @return Content
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }

    /**
     * @param mixed $description
     *
     * @return Content
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param mixed $keywords
     *
     * @return Content
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * @param mixed $name
     *
     * @return Content
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param ContentModel $modelInstance
     *
     * @return Content
     */
    public function setModel(ContentModel $modelInstance)
    {
        $this->modelInstance = $modelInstance;

        return $this;
    }

    /**
     * @param $node
     *
     * @return Content
     */
    public function setNode($node)
    {
        $this->node()->associate($node);

        return $this;
    }

    /**
     * @param         $model
     * @param Closure $callback
     *
     * @return Content
     */
    public function createModel($model, Closure $callback)
    {
        $modelInstance = new $model;

        call_user_func($callback, $model);

        $this->setModel($modelInstance);

        return $this;
    }

    public function save(array $options = [])
    {
        return \DB::transaction(function () use ($options) {
            if (!$this->modelInstance->exists) {
                $this->modelInstance->save();
            }

            $this->contentModel()->associate($this->modelInstance);

            return parent::save($options);
        });
    }
}