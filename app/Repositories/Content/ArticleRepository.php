<?php namespace App\Repositories\Content;

use App\Repositories\BaseRepository;
use App\Models\Article;


/**
 * Class ArticleRepositoryEloquent
 * @package namespace App\Repositories;
 * @property Article $model
 */
class ArticleRepository extends BaseRepository
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
