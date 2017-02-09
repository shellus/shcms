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