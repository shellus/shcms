<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Category
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property integer $parent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\File $logo
 * @property-read mixed $logo_url
 * @property integer $logo_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereLogoId($value)
 * @property string $type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereType($value)
 * @property int $articles_count
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereArticlesCount($value)
 */
abstract class Meta extends Model
{
    protected $fillable = [
        'title','description','parent_id','slug','type',
    ];
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'article_meta', 'meta_id', 'article_id')->withTimestamps();
    }
    public function cacheArticleCount(){
        $this->articles_count = $this->articles()->count();
        $this->save();
    }

    public function logo(){
        return $this->belongsTo('App\Models\File');
    }

    public function getLogoUrlAttribute(){
        if(!$this->logo_id){
            return asset('images/no_category/1.png');
        }
        return $this -> logo -> url;
    }

    /**
     * 生成这个分类的文章数量缓存
     */
    public function buildArticleCountCache(){
        $this->articles_count = $this->articles()->count();
        $this->save();
    }

}
