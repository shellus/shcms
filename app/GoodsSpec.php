<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GoodsSpec
 *
 * @property integer $id
 * @property integer $goods_spec_type_id
 * @property string $title
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpec whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpec whereGoodsSpecTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpec whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpec wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpec whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GoodsSpec whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GoodsSpec extends Model
{
    //
}
