<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Attribute
 *
 * @property integer $id
 * @property string $type
 * @property string $title
 * @property integer $goods_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AttributeOption[] $attributeOptions
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereGoodsTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    public function attributeOptions()
    {
        return $this->hasMany('App\AttributeOption');
    }
}
