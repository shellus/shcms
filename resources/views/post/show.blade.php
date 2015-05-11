@extends('layout')
@section('title'){{ $post->title }} - {{ $post -> categorys[0] -> title }}@endsection
@section('head')
<style>
    .comment-child{
        padding-left: 50px;
    }
    .comment{
        padding-top: 10px;
        /*border-top: 1px dotted #D4D4D4;*/
    }
    .comment-time{
        font-size: 12px;
    }

    .comment-content{
        min-height: 50px;
    }
    .comment-content>.text:before {
        content: "";
        display: block;
        position: absolute;
        left: -7px;
        top: 11px;
        width: 8px;
        height: 8px;
        border: 2px solid #DDE4ED;
        border-width: 2px 0 0 2px;
        background-color: #FFF;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    .comment-content>.text{
        display: inline-block;
        width: auto;
        margin-left: 58px;
        margin-right: 12px;
        position: relative;
        font-size: 18px;
        padding: 5px 15px;

    }
    .comment-content>.text{
        border: 1px solid #DDE4ED;
        border-left-width: 2px;
        margin-right: 1px;
    }
    .comment {
        padding-bottom: 20px;
    }
    .comment {
        padding-right: 3px;
        min-height: 66px;
        position: relative;
    }
    .comment-user{
        display: inline-block;
        width: 50px;
        position: absolute;
        left: 0;
    }
</style>
@endsection
@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ action('IndexController@index') }}">首页</a></li>
        <li><a href="{{ action('PostController@category',$post -> categorys[0]->id) }}">{{ $post -> categorys[0] -> title }}</a></li>
        <li class="active">{{ $post->title }}</li>
    </ol>

    <h1>{{ $post->title }}</h1>
    <hr>
    @if(!\Auth::guest() && $post -> user -> id  == \Auth::user() -> id)
        操作：<a class="btn-link" href="{{ action('PostController@edit',$post->id) }}">编辑</a>

        <form style="display: inline-block" action="{{ action('PostController@destroy',$post->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="delete">
            <input type="submit" class="btn btn-link" value="删除">
        </form>
    @endif
    <div class="">
        <ul class="list-inline tags">
            标签:
            @if(count($post -> tags))
                @foreach($post -> tags as $tag)
                    <li class="label label-success">
                        <a href="{{ action('PostController@tag',$tag->id) }}">{{ $tag -> title }}</a>
                        <a href="{{ route('post.tag.del',[$post->id,$tag->id]) }}" class="close" style="font-size: inherit;"><span aria-hidden="true">&times;</span></a>
                    </li>
                @endforeach
            @else
                none
            @endif
        </ul>
        <ul class="list-inline tags">
            贴一个:
                @foreach(\App\Model\Option::tags() as $tag)
                    <li class="label label-success"><a
                                href="{{ route('post.tag.add',[$post->id,$tag->id]) }}">{{ $tag -> title }}</a></li>
                @endforeach
            <li>
                <form class="form-inline" style="display: inline-block" action="{{ route('tag.store') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input name="title">
                    <input type="submit" value="add">
                </form>
            </li>
        </ul>
    </div>
    <section>
        <article>
            <p>{!! $post->content !!}</p>
        </article>

    </section>
    <hr>
    <ul class="list-unstyled">
        <?php $comments = $post -> comments; ?>
            @include('post.comments', ['comments' => $comments])
    </ul>
    {{ $post -> pager() }}
    <div class="next">
        上一篇：
        @if($post -> previous())
            <a rel="prev" href="{{ route('post.show',$post -> previous() -> id) }}">{{ $post -> previous() -> title }}</a>
        @else
            没有了
        @endif

        下一篇：
        @if($post -> next())
            <a rel="next" href="{{ route('post.show',$post -> next() -> id) }}">{{ $post -> next() -> title }}</a>
        @else
            没有了
        @endif
    </div>
    <div class="" id="comment_editor">
        <h4>添加回复</h4>
        <form class="" onkeydown="if(event.ctrlKey&&event.keyCode==13){this.submit()}event.stopPropagation()"
              action="{{ action('CommentController@store') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="parent_id" value="0">

            <div class="row">
                <div class="form-group col-md-5">
                    <input type="text" class="form-control" name="title" value="re: {{ $post->title }}">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="sr-only">输入评论</label>
                    <textarea class="form-control" name="content"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6 text-right">
                    <input class="btn btn-default" type="submit" value="submit">
                </div>
            </div>
        </form>
    </div>

@endsection

@section('foot')
    <script>
        $('.comment-in-link').on('click',function(event){

            var parent_id = $(this).parent().parent().data('comment-id');
            var title = "re：" + $(this).parent().parent().find('.username').html();

            $('#comment_editor').find('[name="title"]').val(title);
            $('#comment_editor').find('[name="parent_id"]').val(parent_id);
            event.stopPropagation();
            return false;
        });
    </script>
    @endsection