<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property bool $version
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $article_id
 * @property string $type
 * @property bool $is_awesome
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Meta[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read mixed $display_title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereIsAwesome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereVersion($value)
 * @mixin \Eloquent
 */
class Article extends Content
{
    protected $table = 'contents';


    protected $next;
    private $previous;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            return $builder->where('type', '=', 'article');
        });
        static::created(function($model){
            $model->category();
            $model->categories->each->buildArticleCountCache();
        });
    }
    public function __construct(array $attributes = [])
    {
        $attributes['type'] = 'article';
        parent::__construct($attributes);
    }


    public function previous()
    {
        if ($this->previous === null) {
            $this->previous = $this->where('id', '<', $this->id)->first(['id', 'title']);
        }
        return $this->previous;
    }

    public function next()
    {
        if ($this->next === null) {
            $this->next = $this->where('id', '>', $this->id)->first(['id', 'title']);
        }
        return $this->next;
    }
}
