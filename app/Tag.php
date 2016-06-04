<?php

namespace App;
use App\ModelTrait\ModelHelperTrait;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Tag
 *
 * @property integer $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $type
 * @property string $slug
 * @property string $description
 * @property integer $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $childs
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag autoWithAll()
 * @method static \Illuminate\Database\Query\Builder|\App\Tag autoTimeScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Tag autoLimitScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Tag autoOrderScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Tag autoEqualFields($fields)
 */
class Tag extends Meta
{
    use ModelHelperTrait;
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tag', function(Builder $builder) {
            $builder->where('type', '=', 'tag');
        });

        static::creating(function ($user) {
            $user -> type = 'tag';
        });
    }
    public function childs(){
        return $this->hasMany('App\Tag', 'parent_id', 'id');
    }
}
