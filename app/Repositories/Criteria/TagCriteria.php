<?php namespace App\Repositories\Criteria;

use \App\Repositories\CriteriaInterface;
use \App\Repositories\RepositoryInterface;

/**
 * Class TagCriteria
 * @package namespace App\Repositories\Criteria;
 */
class TagCriteria implements CriteriaInterface
{
    public function __construct($meta)
    {
        $this->meta = $meta;
    }
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $meta = $this->meta;
        $model->whereHas('tags', function ($query) use ($meta) {
            $query->where('metas.id', '=', $meta->id);
        });
        return $model;
    }
}
