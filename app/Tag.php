<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2017/2/9
 * Time: 13:33
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Tag
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $type
 * @property string $description
 * @property int $parent_id
 * @property int $logo_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $logo_url
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereLogoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property-read \App\File $logo
 */
class Tag extends Category
{
    protected $table = 'categories';

    protected static function boot()
    {
        static::addGlobalScope('tag', function (Builder $builder) {
            return $builder->where('type', '=', 'tag');
        });
    }

    public function __construct(array $attributes = [])
    {
        $attributes['type'] = 'tag';
        parent::__construct($attributes);
    }

    public function showUrl()
    {
        return route('tag.show', [$this->slug ? $this->slug : $this->id]);
    }
}