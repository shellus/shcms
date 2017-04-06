<?php namespace App\Repositories\Content;

use App\Repositories\BaseRepository;
use App\Models\Tag;

/**
 * Class TagRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TagRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
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
