<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Psy\Util\Json;

class Mindmap extends Model {

    protected $fillable = ['text','field','user_id','parent_id'];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
    public function child(){
        return $this->hasMany('App\Model\Mindmap', 'parent_id', 'id');
    }
    public function parent(){
        return $this->hasOne('App\Model\Mindmap', 'id', 'parent_id');
    }
    public function tree(){
        function getChild($model){
            foreach($model -> child as $child){
                getChild($child);
            }
        }
        getChild($this);
        return $this;
    }
    public function toMindmapJson(){
        $data = $this -> toArray();
        function setNode($node){


            $node['data'] = [
                'text'  => $node['text'],
                'id'    => $node['id'],
                'user_id'    => $node['user_id'],
                'parent_id'    => $node['parent_id'],

                'created_at'    => $node['created_at'],
                'updated_at'    => $node['updated_at'],
            ];


            unset($node['text']);
            unset($node['id']);
            unset($node['user_id']);
            unset($node['parent_id']);

            unset($node['created_at']);
            unset($node['updated_at']);
            unset($node['field']);

            $childs = [];
            foreach($node['child'] as $child){
                $childs[] = setNode($child);
            }
            $node['children'] = $childs;
            unset($node['child']);

            return $node;
        }
        return ['root' => setNode($data)];
    }

}
