<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FavoriteDirectoryStar
 *
 * @property integer $id
 * @property integer $favorite_directory_id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectoryStar whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectoryStar whereFavoriteDirectoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectoryStar whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectoryStar whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FavoriteDirectoryStar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FavoriteDirectoryStar extends Model
{
    protected $fillable = [
        'user_id', 'favorite_id',
    ];
}
