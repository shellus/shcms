@extends('layout')
@section('head')
    <style>
        #post_content {
            min-height: 500px;
            overflow: scroll;
        }
    </style>
@endsection
@section('content')

    <form id="edit"
          onkeydown="if(event.ctrlKey&&event.keyCode==13)$(this).submit()"
          action="{{ action('PostController@update',$post->id) }}"
          onsubmit="post_content_edit.value = post_content.innerHTML"
          enctype="multipart/form-data"
          method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if($type=="update")
            <input type="hidden" name="_method" value="put">
        @endif

        <div class="row">
            <div class="form-group col-md-12">
                <div class="btn-group" data-toggle="buttons">
                    @foreach($categorys as $category)
                        @foreach($post -> categorys as $use_category)
                            @if($use_category->id == $category->id && ($category->use = 'checked'))@endif

                        @endforeach
                        <label class="btn btn-primary {{ $category->use ? 'active' : '' }}">

                            <input type="checkbox" autocomplete="off" {{ $category->use }} name="categorys[]"
                                   value="{{ $category->id }}"> {{ $category->title }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label class="sr-only">标题</label>
                <input class="form-control" name="title" value="{{ $post->title }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label class="sr-only">内容</label>
                <textarea hidden="" name="content" id="post_content_edit">{!! $post->content !!}</textarea>

                <div class="form-control" contenteditable="" id="post_content">{!! $post->content !!}</div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="sr-only">文件</label>
                <input class="form-control" type="file" name="images">
            </div>
        </div>
        <ul class="list-inline tags">
            @foreach($post -> images as $image)
                <li class="">
                    <img src="{{ $image->getFileUrl() }}">
                </li>
            @endforeach
        </ul>
        <div class="row">
            <div class="form-group col-md-6">
                <input type="submit" value="submit">
            </div>
        </div>

    </form>

@endsection