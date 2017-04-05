<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Interfaces\SearchHistoryRepository;
use App\Models\SearchHistory;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Repository\Contracts\CacheableInterface;

/**
 * Class SearchHistoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SearchHistoryRepositoryEloquent extends BaseRepository implements SearchHistoryRepository, CacheableInterface
{
    use CacheableRepository;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SearchHistory::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }
    private function searchHistoryTopListNotCache()
    {
        return SearchHistory::where('page', '=', 1)
            ->orderBy('rows', 'desc')
            ->groupBy('word')
            ->limit(30)
            ->get([\DB::raw('count(*) as rows'), 'word']);
    }
    public function searchHistoryTopList()
    {
        if (!$this->allowedCache('searchHistoryTopList') || $this->isSkippedCache()) {
            return $this->searchHistoryTopListNotCache();
        }
        $key = $this->getCacheKey('searchHistoryTopList', func_get_args());
        $minutes = $this->getCacheMinutes();
        $value = $this->getCacheRepository()->remember($key, $minutes, function () {
            return $this->searchHistoryTopListNotCache();
        });
        return $value;
    }
}
