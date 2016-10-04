<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ArticleReadingAnalysis
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $article_id
 * @property integer $user_id
 * @property string $reading_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleReadingAnalysis whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleReadingAnalysis whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleReadingAnalysis whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleReadingAnalysis whereReadingAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleReadingAnalysis whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleReadingAnalysis whereUpdatedAt($value)
 * @property-read \App\Article $article
 */
class ArticleReadingAnalysis extends Model
{
    protected $fillable = [
        'user_id','article_id','reading_at',
    ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

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
}
