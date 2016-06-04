<?php

namespace App;
use App\ModelTrait\ModelHelperTrait;
use Illuminate\Database\Eloquent\Builder;
/**
 * App\Category
 *
 * @property integer $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $type
 * @property string $slug
 * @property string $description
 * @property integer $parent_id
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category autoWithAll()
 * @method static \Illuminate\Database\Query\Builder|\App\Category autoTimeScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Category autoLimitScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Category autoOrderScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Category autoEqualFields($fields)
 */
class Category extends Meta
{
    use ModelHelperTrait;
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('category', function(Builder $builder) {
            $builder->where('type', '=', 'category');
        });
        static::creating(function ($user) {
            $user -> type = 'category';
        });
    }
}
