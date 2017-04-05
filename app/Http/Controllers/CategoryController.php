<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Meta::withCount('articles')->orderBy('articles_count','DESC')->paginate(\Request::get('pn', 30));

        return view('category.index', compact('categories'));
    }

    public function updateLogo(Request $request)
    {
        if (\Auth::user()->cant('manage_contents')) {
            abort(403);
        }
        $category = Meta::findOrFail($request['meta_id']);
        $file = $request->file('logo');
        if (!$file->isValid()) {
            return $this->fail('上传失败' . $file->getErrorMessage());
        }
        $save_path = 'category_logo/' . $category->id;
        $file_model = File::createFormUploadFile($file, $save_path);
        $category->logo()->associate($file_model);
        $category->save();
        return $this->success('分类LOGO上传成功');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
