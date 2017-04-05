<?php

namespace App\Repositories;

use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ArticleRepository;
use App\Models\Article;


/**
 * Class ArticleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository, CacheableInterface
{
    use CacheableRepository;

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
    }

    /**
     * @param array $attributes
     * @return Article
     */
    public function create(array $attributes)
    {
        $attributes['type'] = 'article';

        /** @var Article $result */
        $result = parent::create($attributes);
        $result->category();
        $result->categories->each->buildArticleCountCache();
        return $result;
    }

    public function delete($id)
    {
        $categories = $this->model->find($id)->categories;
        /** @var Article $result */
        $result = parent::delete($id);
        $categories->each->buildArticleCountCache();
        return $result;
    }

    public function attachCategory($articleId, $id, array $attributes = [], $touch = true)
    {
        $article = $this->model->find($articleId);
        $article->categories()->attach($id, $attributes, $touch);
    }
}
