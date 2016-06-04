<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Meta extends Model
{
    protected $table = 'metas';
    protected $fillable = [
        'title','user_id','description','parent_id'
    ];
}
 