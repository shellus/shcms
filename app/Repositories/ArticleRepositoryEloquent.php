<?php

namespace App\Repositories;

use App\Comment;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ArticleRepository;
use App\Models\Article;

/**
 * Class ArticleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    protected $fieldSearchable = [
        'title'=>'like',
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }


    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public static function searchHistoryTopList()
    {
        return \App\SearchHistory::selectRaw('count(*) as rows ,word')->where('page', '=', 1)->orderByRaw('rows desc')->groupBy('word')->limit(30)->get();
    }
    public function create(array $attributes)
    {
        $attributes['type'] = 'article';
        return parent::create($attributes);
    }
}
