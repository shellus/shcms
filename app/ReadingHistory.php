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
 * @property integer $reading_at
 * @property-read \App\Article $article
 * @method static \Illuminate\Database\Query\Builder|\App\ReadingHistory whereReadingAt($value)
 */
class ReadingHistory extends Model
{
    protected $fillable = [
        'user_id','article_id','reading_at',
    ];
    public static function reading($user_id, $id)
    {
        $attr = [
            'user_id' => $user_id,
            'article_id' => $id,
        ];

        $model = static::firstOrCreate($attr,$attr);

        $model -> reading_at += 1;


        return $model -> save();
    }
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
