<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ShopCart
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $goods_id
 * @property integer $quantity
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Item $goods
 * @method static \Illuminate\Database\Query\Builder|\App\ShopCart whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ShopCart whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ShopCart whereGoodsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ShopCart whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ShopCart whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ShopCart whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShopCart extends Model
{
    protected $fillable = [
        'goods_id', 'quantity', 'user_id'
    ];

    public static function create(array $attributes = [])
    {
        $spec_types = Item::find($attributes['goods_id']) -> goods_spec_types;
        foreach ($spec_types as $spec_type){
            if(! key_exists('spec_type_' . $spec_type -> id, $attributes)){
                // input不存在。
                throw new \Exception('还没有选择' . $spec_type -> title);
            }else{
                $gst = $spec_type -> goods_specs() -> whereId($attributes['spec_type_' . $spec_type -> id]) -> exists();
                if(!$gst){
                    // 值不属于该规格类型
                    throw new \Exception('还没有选择' . $spec_type -> title);
                }else{
                    // 添加购物车商品 的 属性选择记录 shop_cart_goods_spec todo
                }
            }
        }


        $model = new static($attributes);

        $model->save();

        return $model;
    }
    public function showUrl(){
        return '#';
    }

    public function goods(){
        return $this->belongsTo('App\Item');
    }
}
