<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-05-26
 * Time: 16:02
 */

namespace App\ModelTrait;
use Illuminate\Database\Eloquent\Builder;
use Request;
trait ModelHelperTrait
{

    public function scopeAutoWithAll (Builder $builder) {
        $this -> scopeAutoTimeScope($builder);
        $this -> scopeAutoLimitScope($builder);
        $this -> scopeAutoOrderScope($builder);
        $this -> scopeAutoEqualFields($builder, Request::all());
    }

    public function scopeAutoTimeScope(Builder $builder){
        Request::input('start_at') !== null &&
        $builder->where('created_at', '>', Request::input('start_at'));
        Request::input('stop_at') !== null &&
        $builder->where('created_at', '<', Request::input('stop_at'));
    }

    public function scopeAutoLimitScope(Builder $builder){
        Request::input('limit')!== null && $builder->take(Request::input('limit'));
    }

    public function scopeAutoOrderScope(Builder $builder){
        if(Request::input('order') !== null){
            if(Request::input('order') === "rand"){
                $builder->orderByRaw("RAND()");
            }else{
                $builder -> orderBy(Request::input('order'), 'desc');
            }
        }
    }

    public function scopeAutoEqualFields(Builder $builder, $fields){
        $columns = \Schema::getColumnListing($this -> getTable());

        foreach ($fields as $field => $value) {
            if(Request::input($field) !== null && in_array($field, $columns)){
                $builder->where($field, Request::input($field));
            }
        }
    }
}