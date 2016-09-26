<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Articles
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $user_id
 * @property string $referrer_title
 * @property string $referrer
 * @property boolean $to_local
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereReferrerTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereReferrer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereToLocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property boolean $version
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereVersion($value)
 */
class Article extends Model
{
    protected $next = null;
    protected $fillable = [
        'title','body','referrer_title', 'referrer','version','to_local',
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
    public function showUrl(){
        return route('article.show', [$this -> id]);
    }


    public static function getByRandom($count){
        $total = Article::count();
        $randoms = [];
        $ids = [];

        $articles = [];


        do{
            $randoms[] = rand(0, $total);
        }while ($count --> 1);

        $all_ids = \Cache::rememberForever('all_ids', function() {
            return \DB::select('select `id` from `articles`;');
        });

        foreach ($randoms as $random){
            $ids[] = $all_ids[$random] -> id;
        }

//        $articles = Article::limit(10) -> orderByRaw('RAND()') -> get();

        $articles = Article::whereIn('id', $randoms) -> get(['id', 'title']);

        return $articles;
    }
    public function next(){

        if ($this -> next === null){
            $this -> next = $this -> where('id', '>', $this -> id) -> first(['id', 'title']);
        }
        return $this -> next;
    }
}
