<?php

namespace App;

use App\ModelTrait\ModelHelperTrait;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Article
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categorys
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property boolean $to_local
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereToLocal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoWithAll()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoTimeScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoLimitScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoOrderScope()
 * @method static \Illuminate\Database\Query\Builder|\App\Article autoEqualFields($fields)
 */
class Article extends Model
{
    use ModelHelperTrait;
    protected $fillable = [
        'title', 'body', 'user_id',
    ];
    protected $planar = [
        'user.display_name',
    ];

    public function showUrl(){
        return route('article.show',['id' => $this->id]);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function categorys()
    {
        return $this->belongsToMany('App\Category','article_meta','article_id','meta_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Tag','article_meta','article_id','meta_id');
    }
    public function relationsToArray()
    {
        $attributes = [];

        foreach ($this->getArrayableRelations() as $key => $value) {
            // If the values implements the Arrayable interface we can just call this
            // toArray method on the instances which will convert both models and
            // collections to their proper array form and we'll set the values.
            if ($value instanceof Arrayable) {
                $relation = $value->toArray();
            }

            // If the value is null, we'll still go ahead and set it in this list of
            // attributes since null is used to represent empty relationships if
            // if it a has one or belongs to type relationships on the models.
            elseif (is_null($value)) {
                $relation = $value;
            }

            // If the relationships snake-casing is enabled, we will snake case this
            // key so that the relation attribute is snake cased in this returned
            // array to the developers, making this consistent with attributes.
            if (static::$snakeAttributes) {
                $key = Str::snake($key);
            }

            // If the relation value has been set, we will set it on this attributes
            // list for returning. If it was not arrayable or null, we'll not set
            // the value on the array because it is some type of invalid value.
            if (isset($relation) || is_null($value)) {

                /**
                 * add
                 */
//                foreach ($relation as $item => $value){
//                    $attributes[$key . '_' . $item] = $value;
//                }
                /**
                 * del
                 */
                $attributes[$key] = $relation;
            }

            unset($relation);
        }

        return $attributes;
    }
}
