<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReadingHistory
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $article_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ReadingHistory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReadingHistory whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReadingHistory whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReadingHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ReadingHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReadingHistory extends Model
{
    protected $fillable = [
        'article_id','user_id'
    ];

}
