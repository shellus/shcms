<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
