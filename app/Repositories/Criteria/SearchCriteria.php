<?php namespace App\Repositories\Criteria;

use \App\Repositories\CriteriaInterface;
use \App\Repositories\RepositoryInterface;

/**
 * Class SearchCriteria
 * @package namespace App\Repositories\Criteria;
 */
class SearchCriteria implements CriteriaInterface
{
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
        return $model;
    }
}
