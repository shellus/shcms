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

    public function showUrl(){
        return '#';
    }

    public function goods(){
        return $this->belongsTo('App\Item');
    }
}
