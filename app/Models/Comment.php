<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Comment
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
 * @property-read \App\Models\Article $article
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Meta[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read mixed $display_title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereIsAwesome($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereVersion($value)
 * @mixin \Eloquent
 */
class Comment extends Content
{
    protected $table = 'contents';


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            return $builder->where('type', '=', 'comment');
        });
        static::created(function($model){
            $model->category();
            $model->categories->each->buildArticleCountCache();
        });
    }
    public function __construct(array $attributes = [])
    {
        $attributes['type'] = 'comment';
        parent::__construct($attributes);
    }

    // 触发的关联关系updated_at时间戳
    protected $touches = ['article'];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
