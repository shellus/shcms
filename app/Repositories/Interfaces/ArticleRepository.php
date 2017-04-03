<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ArticleRepository
 * @package namespace App\Repositories\Interfaces;
 */
interface ArticleRepository extends RepositoryInterface
{
    /**
     * Push Criteria for filter the query
     *
     * @param $criteria
     *
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function pushCriteria($criteria);
}
