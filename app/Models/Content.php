<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

abstract class Content extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id', 'slug', 'version', 'type', 'article_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'article_id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'article_meta', 'article_id', 'meta_id')->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_meta', 'article_id', 'meta_id')->withTimestamps();
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
            /** @var Meta $model */
            $model = Category::firstOrCreate(Arr::only($c, ['slug']), $c);
            $this->categories()->attach($model);
        }
        return $model;
    }
}
