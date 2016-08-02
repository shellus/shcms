<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function files()
    {
        return $this->belongsToMany('App\File');
    }
}
