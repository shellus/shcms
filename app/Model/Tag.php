<?php namespace App\Model;


class Tag extends Option {

	protected $table='options';
    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return static
     */
    public static function create(array $attributes)
    {
        $attributes['type'] = 'tag';
        $attributes['name'] = array_key_exists('name',$attributes)?$attributes['name']:'';
        $attributes['value'] = array_key_exists('value',$attributes)?$attributes['value']:'';
        return parent::create($attributes);
    }

    public static function all($columns = array('*'))
    {
        $instance = new static;

        return $instance->newQuery() -> where('type', 'tag')->get($columns);
    }
}
