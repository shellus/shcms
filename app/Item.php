<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function files()
    {
        return $this->belongsToMany('App\File');
    }
    public function showUrl(){
        return 'https://item.taobao.com/item.htm?spm=a3109.6190702.1998615668.161.dx9tga&id=' . $this -> slug;
//        return route('item.show',$this -> id);
    }
}
