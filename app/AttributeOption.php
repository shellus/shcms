<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AttributeOption
 *
 * @property integer $id
 * @property string $title
 * @property string $value
 * @property integer $attribute_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeOption whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeOption whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeOption whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeOption whereAttributeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\AttributeOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttributeOption extends Model
{
    public static function create(array $attributes = [])
    {

        $model = new static($attributes);

        // 补充value

        if(!$model -> value){

            $model -> value = $model -> title;
        }
        $model->save();

        return $model;
    }
}
