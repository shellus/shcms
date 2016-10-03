<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 收藏
 * Class Favorite
 *
 * @package App
 * @property integer $id
 * @property integer $favorite_directory_id
 * @property integer $article_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereFavoriteDirectoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Favorite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Favorite extends Model
{
    //
}
