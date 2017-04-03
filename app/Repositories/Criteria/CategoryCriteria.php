<?php

namespace App\Repositories\Criteria;

use App\Category;
use App\Tag;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoryCriteria
 * @package namespace App\Repositories\Criteria;
 */
class CategoryCriteria implements CriteriaInterface
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
        $model->whereHas('categories', function ($query) use ($meta) {
            $query->where('categories.id', '=', $meta->id);
        });
        return $model;
    }
}
