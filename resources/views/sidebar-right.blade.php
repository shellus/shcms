<h3>随机推荐</h3>
<ul>
    @foreach(\App\Model\Post::where('id','>',rand(\App\Model\Post::min('id'),\App\Model\Post::max('id') - 10))->paginate(10) as $post)
        <li><a href="{{ action('PostController@show',$post->id) }}">{{$post -> title}}</a></li>
    @endforeach
</ul>