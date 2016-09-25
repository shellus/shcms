<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title','description','parent_id','slug',
    ];

    public function articles()
    {
        return $this->belongsToMany('App\Article')->withTimestamps();
    }
}
