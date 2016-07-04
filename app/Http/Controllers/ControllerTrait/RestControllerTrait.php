<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2016-05-26
 * Time: 20:46
 */

namespace App\Http\Controllers\ControllerTrait;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class RestControllerTrait
 * @package App\Http\Controllers\ControllerTrait
 *  * @property Model $model
 */
trait RestControllerTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this -> model ->all();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $columns = $this -> model -> getFillable();
        $route = array_first(explode('/',request() -> path()));
        $post_url = route($route . '.store');
        return view('common/create', ['columns' => $columns, 'submit_url' => $post_url]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this -> model -> create($request -> all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this -> model -> findOrFail($id);
        $route = array_first(explode('/',request() -> path()));
        return view('common/show', ['model' => $data, 'route' => $route]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this -> model -> findOrFail($id);
        $route = array_first(explode('/',request() -> path()));
        $post_url = route($route . '.edit');
        return view('common/edit', ['model' => $data, 'submit_url' => $post_url]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}