<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-05-26
 * Time: 16:02
 */

namespace App\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Request;
trait ModelHelperTrait
{

    public static function scopeAutoWithAll (Builder $builder) {
        static::scopeAutoTimeScope($builder);
        static::scopeAutoLimitScope($builder);
        static::scopeAutoOrderScope($builder);
        static::scopeAutoEqualFields($builder, Request::all());
    }

    public static function scopeAutoTimeScope(Builder $builder){
        Request::input('start_at') !== null &&
        $builder->where('created_at', '>', Request::input('start_at'));
        Request::input('stop_at') !== null &&
        $builder->where('created_at', '<', Request::input('stop_at'));
    }

    public static function scopeAutoLimitScope(Builder $builder){
        Request::input('limit')!== null && $builder->take(Request::input('limit'));
    }

    public static function scopeAutoOrderScope(Builder $builder){
        if(Request::input('order') !== null){
            if(Request::input('order') === "rand"){
                $builder->orderByRaw("RAND()");
            }else{
                $builder -> orderBy(Request::input('order'), 'desc');
            }
        }
    }

    public static function scopeAutoEqualFields(Builder $builder, $fields){
        $columns = \Schema::getColumnListing((new static) -> getTable());

        foreach ($fields as $field => $value) {
            if(Request::input($field) !== null && in_array($field, $columns)){
                $builder->where($field, Request::input($field));
            }
        }
    }
}