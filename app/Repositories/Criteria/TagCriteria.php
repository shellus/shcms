<?php

namespace App\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

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
            $query->where('categories.id', '=', $meta->id);
        });
        return $model;
    }
}
