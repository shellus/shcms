<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 收藏夹
 * Class FavoriteDirectory
 *
 * @package App
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectory whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FavoriteDirectory extends Model
{
    //
}
