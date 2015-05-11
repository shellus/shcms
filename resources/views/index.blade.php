@extends('layout')
@section('title')首页@endsection
@section('content')

        <div class="page-header">
            <h1>首页 <small>欢迎你的到来</small></h1>

        </div>
        <section>
            <div class="row">
                <div class="col-md-6">
                    <h3>随机推荐</h3>
                    <ul>
                        @foreach(\App\Model\Post::where('id','>',rand(\App\Model\Post::min('id'),\App\Model\Post::max('id') - 10))->paginate(25) as $post)
                            <li><a href="{{ action('PostController@show',$post->id) }}">{{$post -> title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <h3>标签</h3>
                    <ul class="list-unstyled list-inline">
                        @foreach(\App\Model\Tag::all() as $meta)
                            <li><a href="{{ action('PostController@tag',$meta->id) }}">{{$meta -> title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

@endsection