<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsSpecType extends Model
{
    public function goods_specs()
    {
        return $this->hasMany('App\GoodsSpec');
    }
}
