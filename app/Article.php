<?php

namespace App;

use App\ModelTrait\ModelHelperTrait;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Article
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categorys
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property boolean $to_local
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereToLocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoWithAll()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoTimeScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoLimitScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoOrderScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoEqualFields($fields)
 */
class Article extends Model
{
    use ModelHelperTrait;
    protected $fillable = [
        'title', 'body', 'user_id',
    ];
    protected $planar = [
        'user.display_name',
    ];

    public function showUrl(){
        return route('article.show',['id' => $this->id]);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function categorys()
    {
        return $this->belongsToMany('App\Category','article_meta','article_id','meta_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag','article_meta','article_id','meta_id');
    }
    public static function getNewList($limit = 10){
        return static::take($limit) -> get();
    }
    public function getRouteUrl(){
        return route('article.show', $this);
    }
}
