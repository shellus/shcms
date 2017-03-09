<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
/**
 * App\Comment
 *
 * @property int $id
 * @property int $article_id
 * @property int $user_id
 * @property int $parent_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereUserId($value)
 * @mixin \Eloquent
 * @property string $slug
 * @property-read \App\Article $article
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereSlug($value)
 * @property bool $is_awesome
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereIsAwesome($value)
 * @property string $title
 * @property bool $version
 * @property string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read mixed $display_title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\KeyWords[] $keyWords
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReadingHistory[] $readingHistories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ArticleVote[] $votes
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Comment whereVersion($value)
 */
class Comment extends Article
{
    protected $table = 'articles';

    public function __construct(array $attributes = [])
    {
        if (empty($attributes['type'])) $attributes['type'] = 'comment';
        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder)
        {
            return $builder->where('type', '=', 'comment');
        });

    }

    // 触发的关联关系updated_at时间戳
    protected $touches = ['article'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
