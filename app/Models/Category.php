<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Category extends Meta
{
    protected $table = 'metas';

    protected static function boot()
    {
        static::addGlobalScope('category', function (Builder $builder) {
            return $builder->where('type', '=', 'category');
        });
    }

    public function __construct(array $attributes = [])
    {
        $attributes['type'] = 'category';
        parent::__construct($attributes);
    }

    public function showUrl()
    {
        return route('category.show', [$this->slug ? $this->slug : $this->id]);
    }
}
