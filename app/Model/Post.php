<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $fillable = ['title','content','user_id'];

    public function delete(){

        $this -> tags() -> detach();
        $this -> categorys() -> detach();
        $this -> images() -> delete();
        $this -> comments() -> delete();
        Model::delete();
    }

    public function tags()
    {
        $result = $this->belongsToMany('App\Model\Option');
        $result -> getQuery() -> where('type' ,'=', 'tag');
        return $result;
    }


    public function categorys()
    {
        $result = $this->belongsToMany('App\Model\Option');
        $result -> getQuery() -> where('type' ,'=', 'category');
        return $result;
    }


    public function images(){
        $result = $this->hasMany('App\Model\File','name');
        $result -> getQuery() -> where('type' ,'=', 'post_image');
        return $result;
    }

    public function comments()
    {
        $result = $this->hasMany('App\Model\Comment');
        $result -> getQuery() -> where('parent_id','=','0');
        return $result;
    }
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    /**
     * 上一篇下一篇的导航
     */
    public function pager(){
        /*
        if($previous = $this -> next()){
            $previous_val = ['title'=> $previous -> title,'id'=> $previous -> id];
        }else{
            $previous_val = ['title'=> '没有了','id'=> $previous -> id];
        }

        if($previous = $this -> previous()){
            $next_val = ['title'=> $previous -> title,'id'=> $previous -> id];
        }

       return '<div class="next">\
            上一篇：<a rel="previous" href="{{ route('post.show',$previous -> id) }}">{{ $previous -> title }}</a>\
            下一篇：<a rel="next" href="{{ route('post.show',$next -> id) }}">{{ $next -> title }}</a>\
        </div>';
        */
    }

    public function next(){
        $post = $this
            -> categorys[0]
            -> posts()
            -> where('id','>',$this -> id)
            -> first();
        return $post;
    }
    public function previous(){
        $post = $this
            -> categorys[0]
            -> posts()
            -> where('id','<',$this -> id)
            -> orderBy('id','desc')
            -> first();
        return $post;
    }
}