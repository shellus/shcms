<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Category
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $parent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\File $logo
 * @property-read mixed $logo_url
 * @property integer $logo_id
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereLogoId($value)
 */
class Category extends Model
{


    protected $fillable = [
        'title','description','parent_id','slug','type',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('category', function (Builder $builder)
        {
            return $builder->where('type', '=', 'category');
        });

    }

    public function articles()
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }

    public function showUrl(){
        return route('category.show', [$this -> id]);
    }
    public function logo(){
        return $this->belongsTo('App\File');
    }
    public function getLogoUrlAttribute(){
        if(!$this->logo){
            return asset('images/no_category/1.png');
        }
        return $this -> logo -> url;
    }
}
