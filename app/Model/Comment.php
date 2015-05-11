<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {


    protected $fillable = ['title','content','post_id','user_id','parent_id'];


    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
    public function child(){
        return $this->hasMany('App\Model\Comment', 'parent_id', 'id');
    }
    public function parent(){
        return $this->hasOne('App\Model\Comment', 'id', 'parent_id');
    }
}
