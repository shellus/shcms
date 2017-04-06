<?php namespace App\Repositories\Content;

use App\Repositories\BaseRepository;
use App\Models\SearchHistory;

/**
 * Class SearchHistoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SearchHistoryRepository extends BaseRepository
{
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
    public function searchHistoryTopList()
    {
        return SearchHistory::where('page', '=', 1)
            ->orderBy('rows', 'desc')
            ->groupBy('word')
            ->limit(30)
            ->get([\DB::raw('count(*) as rows'), 'word']);
    }
}
