<?php namespace App\Repositories\Content;

use App\Repositories\BaseRepository;
use App\Models\Category;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CategoryRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
    }

    public function TagTopList(){
        return $this->model->orderBy('articles_count', 'DESC')->limit(40)->get();
    }
}
