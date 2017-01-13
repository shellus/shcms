<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read mixed $display_title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ArticleVote[] $votes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ReadingHistory[] $readingHistories
 */
class Article extends Model
{
    protected $next = null;
    protected $fillable = [
        'title','body', 'user_id','referrer_title', 'referrer','version','to_local',
    ];
    private $previous;

    public function getDisplayTitleAttribute()
    {
        $value = $this -> title;
        if (mb_strlen($value) >15){
            $value = mb_substr($value,0,15) . '...';
        }
        return $value;
    }
    public static function searchHistoryTopList(){
        return \App\SearchHistory::selectRaw('count(*) as rows ,word') -> where('page', '=', 1) -> orderByRaw('rows desc') -> groupBy('word') -> limit(30) -> get();
    }
    public static function search($s, $c = [], $perPage = 20){

        if(!class_exists('\SphinxClient')){
            return Article::whereRaw("`title` LIKE ?", ["%" . $s . "%"]) -> paginate();
        }

        if ($c === null){
            $c = Category::all(['id']) -> mode('id');
        }
        $currentPage = \Request::get('page',1);

        $sphinx = new \SphinxClient();

        $sphinx->setMatchMode(2);

        $sphinx->SetServer ('127.0.0.1', 9312);

        $sphinx->SetArrayResult (true);

        $sphinx->SetLimits($perPage * ($currentPage - 1), $perPage, 100000);

        $sphinx->SetMaxQueryTime(10);

        $index = '*';

        $sphinx->SetFilter('category_id', $c);

//        $key = mb_convert_encoding($key, 'UTF-8');

        $result = $sphinx->query ($s, $index);

        if($result === false){
            throw new \Exception('sphinx error');
        }
        $total = $result['total'];

        $ids = [];

        if(key_exists('matches',$result)){
            foreach ($result['matches'] as $match){
                $ids[] = $match['id'];
            }
        }

        $items = Article::whereIn('id', $ids) -> get(['id', 'title']);

        $articles = new \Illuminate\Pagination\LengthAwarePaginator($items, $total, $perPage, $currentPage,
            [
                'path' => '/' . \Request::path(),
                'query' => \Request::all(),
            ]
        );

        return $articles;
    }

    public function currentUserVote(){
        return $this -> votes() -> whereUserId(\Auth::user()->id) -> sum('vote');
    }

    public function votes()
    {
        return $this->hasMany('App\ArticleVote');
    }
    public function readingHistories()
    {
        return $this->hasMany('App\ReadingHistory');
    }
    public function category(){
        try{
            $model = $this -> categories() -> firstOrFail();
        }catch (ModelNotFoundException $e){
            $model = $this -> categories() -> whereSlug('default') -> firstOrCreate([
                'slug' => 'default',
                'title' => '缺省分类',
                'description' => '系统自动创建的'
            ]);
        }
        return $model;
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    /**
     * 关键词关联，通过中间表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keyWords()
    {
        return $this->belongsToMany('App\KeyWords')->withTimestamps();
    }
    public function showUrl(){
        return route('article.show', [$this -> id]);
    }


    public static function getByRandom($count){
        $ids = Article::orderBy(\DB::raw('RAND()'))->limit($count)->get(['id']);

        return Article::whereIn('id', $ids)->get(['id', 'title', \DB::raw('substr(`body`,1,100) as body')]);
    }
    public function previous(){
        if ($this -> previous === null){
            $this -> previous = $this -> where('id', '<', $this -> id) -> first(['id', 'title']);
        }
        return $this -> previous;
    }
    public function next(){

        if ($this -> next === null){
            $this -> next = $this -> where('id', '>', $this -> id) -> first(['id', 'title']);
        }
        return $this -> next;
    }
}
