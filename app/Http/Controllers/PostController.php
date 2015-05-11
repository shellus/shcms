<?php namespace App\Http\Controllers;

use App\Model\Post;
use App\Http\Requests;

class PostController extends Controller
{

    public function index()
    {
        $posts = \App\Model\Post::orderBy('id', 'desc')->paginate(25);
        return view('post/list')->with('posts', $posts)->with('type', ['name' => 'post', 'title' => '帖子']);
    }

    public function search()
    {
        $input = \Request::all();
        $s = $input['s'];
        $model = new \App\Model\Post();
        $posts = $model->where('title', 'like', "%{$s}%")
            ->orWhere('content', 'like', "%{$s}%")
            ->paginate(25)
            ->appends($input);

        return view('post/list')->with('posts', $posts)->with('type', ['name' => 'search', 'title' => "搜索: \"$s\""]);
    }

    public function tag($id)
    {
        $tag = \App\Model\Option::find($id);
        $posts = $tag->posts()->paginate(25);
        $s = $tag->title;
        return view('post/list')->with('posts', $posts)->with('type', ['name' => 'tag', 'title' => "标签: \"$s\""]);
    }
    public function user($id)
    {
        $user = \App\Model\User::find($id);
        $posts = $user->posts()->paginate(25);
        $s = $user->name;
        return view('post/list')->with('posts', $posts)->with('type', ['name' => 'tag', 'title' => "\"$s\"发表"]);
    }

    public function category($id)
    {
        $category = \App\Model\Option::find($id);
        $posts = $category->posts()->paginate(25);
        $s = $category->title;
        return view('post/list')->with('posts', $posts)->with('type', ['name' => 'category', 'title' => "分类: \"$s\""]);
    }


    public function random()
    {
        $model = new \App\Model\Post();
        $begin = rand($model->min('id'), $model->max('id') - 25);
        $posts = $model->where('id', '>', $begin)->paginate(25);
        return view('post/list')->with('posts', $posts)->with('type', ['name' => 'random', 'title' => "随机"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('post.edit')->with('type', 'store')->with('post', new \App\Model\Post())->with('categorys', \App\Model\Option::whereType('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $data = \Input::all();
        $data['user_id'] = \Auth::user() -> id;
        $post = \App\Model\Post::create($data);
        $this->upExtDate($post);
        return back();
    }

    private function upExtDate($post)
    {
        if (is_array(\Input::get('categorys'))){
            $post->categorys()->sync(\Input::get('categorys'));
        }

        if(\Input::file('images')){
            if(!is_array(\Input::file('images'))){
                $files = [\Input::file('images')];
            }else{
                $files = \Input::file('images');
            }

            foreach($files as $file){
                \App\Model\File::create([
                    'file' => $file,
                    'type' => 'post_image',
                    'name' => $post->id,
                ]);
            }
        }

    }
    /*
        public function main($id)
        {
            \App\Model\Option::setPostMain($id,\App\Model\Option::createFile(\Input::file('file')));
            return back();
        }
        public function file($id)
        {
            \App\Model\Option::setPostFile($id,\App\Model\Option::createFile(\Input::file('file')));
            return back();
        }
        public function image($id)
        {
            \App\Model\Option::setPostImage($id,\App\Model\Option::createFile(\Input::file('file')));
            return back();
        }
        */

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        $post = \App\Model\Post::find($id);

        return view('post/show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $post = \App\Model\Post::find($id);
        return view('post/edit')->with('type', 'update')->with('post', $post)->with('categorys', \App\Model\Option::whereType('category')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $post = \App\Model\Post::find($id);
        $post->update(\Input::all());
        $this->upExtDate($post);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect('post');
    }

}
