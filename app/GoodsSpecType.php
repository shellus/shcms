<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GoodsSpecType
 *
 * @property integer $id
 * @property integer $goods_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GoodsSpec[] $goods_specs
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpecType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpecType whereGoodsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpecType whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpecType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpecType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GoodsSpecType extends Model
{
    public function goods_specs()
    {
        return $this->hasMany('App\GoodsSpec');
    }
}
