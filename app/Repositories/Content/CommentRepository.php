<?php namespace App\Repositories\Content;

use App\Repositories\BaseRepository;
use App\Models\Comment;

/**
 * Class CommentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CommentRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {

    }
}
