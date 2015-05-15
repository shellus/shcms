<?php namespace App\Model\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2015-05-15
 * Time: 12:07
 *
 */
class TagScope implements ScopeInterface{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */

    public function apply(Builder $builder, Model $model)
    {
        $builder->where('type', '=', 'tag');
    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     *
     * @return void
     */
    public function remove(Builder $builder, Model $model)
    {
        $column = $model->getQualifiedDeletedAtColumn();

        $query = $builder->getQuery();

        foreach ((array) $query->wheres as $key => $where)
        {
            // If the where clause is a soft delete date constraint, we will remove it from
            // the query and reset the keys on the wheres. This allows this developer to
            // include deleted model in a relationship result set that is lazy loaded.
            dd($where);

            if ($this->isSoftDeleteConstraint($where, 'type'))
            {
                unset($query->wheres[$key]);

                $query->wheres = array_values($query->wheres);
            }
        }
    }
}