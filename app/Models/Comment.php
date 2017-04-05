<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Comment extends \App\Models\Article implements Transformable
{
    use TransformableTrait;

    protected $table = 'articles';


    public function __construct(array $attributes = [])
    {
        if (empty($attributes['type'])) $attributes['type'] = 'comment';
        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder)
        {
            return $builder->where('type', '=', 'comment');
        });

    }

    // 触发的关联关系updated_at时间戳
    protected $touches = ['article'];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
