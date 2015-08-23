<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {

    public static function get($key){
        return self::where('type', 'site')->where('name', $key) -> first() -> value;
    }
    public static function set($key,$value){

        $attributes = [
            'type' => 'site',
            'name' =>  $key,
        ];
        $model = self::firstOrNew($attributes);
        $model -> title = $model -> title?:'';
        $model -> value = $value;

        return $model -> save()?$model -> value:'';
    }

}
