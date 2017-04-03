<?php

namespace App\Models;

use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'title', 'body', 'user_id', 'slug', 'version', 'type', 'article_id',
    ];
    protected $next;
    private $previous;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            return $builder->where('type', '=', 'article');
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'article_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_category', 'article_id', 'category_id')->withTimestamps();
    }
    public function showUrl()
    {
        return route('article.show', [$this->id]);
    }
    public function getDisplayTitleAttribute()
    {
        return $this->title;
    }
    public function category()
    {
        try {
            $model = $this->categories()->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $c = [
                'slug' => 'default',
                'title' => '缺省分类',
                'description' => '系统自动创建的'
            ];
            /** @var Category $model */
            $model = Category::firstOrCreate(Arr::only($c, ['slug']), $c);
            $this->categories()->attach($model);
        }
        return $model;
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
