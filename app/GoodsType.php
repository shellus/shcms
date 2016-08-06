<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GoodsType
 *
 * @property integer $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attribute[] $attributes
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsType whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GoodsType extends Model
{
    //


    

    public function attributes()
    {
        return $this->hasMany('App\Attribute');
    }
}
