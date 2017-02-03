<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 */
class Comment extends Model
{
    protected $fillable = [
        'body', 'user_id', 'article_id', 'slug', 'is_awesome',
    ];
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
