<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Item
 *
 * @property integer $id
 * @property string $slug
 * @property string $shop_id
 * @property string $shop_name
 * @property string $title
 * @property float $price
 * @property float $discount
 * @property float $discount_price
 * @property integer $quantity
 * @property integer $current_quantity
 * @property integer $sell_out
 * @property integer $current_sell_out
 * @property integer $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\File[] $files
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereShopId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereShopName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereDiscount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereDiscountPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCurrentQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereSellOut($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCurrentSellOut($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Item whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GoodsSpecType[] $goods_spec_types
 */
class Item extends Model
{
    public function files()
    {
        return $this->belongsToMany('App\File');
    }
    public function goods_spec_types()
    {
        return $this->hasMany('App\GoodsSpecType','goods_id');
    }
    public function showUrl(){
//        return 'https://item.taobao.com/item.htm?spm=a3109.6190702.1998615668.161.dx9tga&id=' . $this -> slug;
        return route('goods.show',$this -> id);
    }
    public function getImageAttribute()
    {
        return $this -> files -> first() -> showUrl();
    }
}
