@extends('layout')
@section('head')
    <style>
        article img{
            max-width: 100%;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid">
    <h1>{{ $model->title }}</h1>
    <hr>
    <p class="article-tags">
        tags:
        <ul class="list-inline">
        @foreach ($model->tags as $tag)
            <li><a title="{{ $tag -> description }}" href="{{ $tag->articleUrl() }}"><span class="label label-success">{{ $tag->title }}</span></a></li>
        @endforeach
        </ul>
        add:
    <ul class="list-inline">
        @foreach (\App\Tag::all() as $tag)
            <li><a title="{{ $tag -> description }}" href="{{ route('article.tag.add',[$model->id, $tag->id]) }}"><span class="label label-info">{{ $tag->title }}</span></a></li>
        @endforeach
    </ul>
    <form class="form-inline" style="display: inline-block" action="{{ route('tag.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="title">
        <input type="submit" value="add">
    </form>
    </p>
    <section>
        <article>
            <p>{!! $model -> body !!}</p>
        </article>

    </section>
</div>
@endsection
