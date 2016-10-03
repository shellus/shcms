<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * App\ArticleVote
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $article_id
 * @property boolean $vote
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleVote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleVote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleVote whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleVote whereVote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleVote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ArticleVote extends Model
{
    protected $fillable = [
        'user_id','article_id',
    ];
    //
    public static function voteUp($data){
        $model = self::getOrCreate($data);
        if ($model -> vote >= 1){
            return false;
        }else{
            $model -> vote = $model -> vote + 1;
            return $model -> save();
        }
    }


    public static function voteDown($data){
        $model = self::getOrCreate($data);
        if ($model -> vote <= -1){
            return false;
        }else{
            $model -> vote = $model -> vote - 1;
            return $model -> save();
        }
    }

    private static function getOrCreate($data){
        $wh = Arr::only($data,['user_id', 'article_id']);
        return self::firstOrCreate($wh);
    }
}
