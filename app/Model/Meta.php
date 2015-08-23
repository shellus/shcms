<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model {

    protected $fillable=['type','name','value','title'];

    public function posts(){
        return $this->belongsToMany('App\Model\Post');
    }

    public static function tags(){
        return self::where('type','=','tag') -> get();
    }

    public function postCount(){
        return $this->posts() -> count();
    }

}
