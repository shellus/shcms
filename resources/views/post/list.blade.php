@extends('layout')

@section('title'){{ $type['title'] }}@endsection
@section('content')
    <div class="row">

        <div class="col-md-6">
            <h3>{{ $type['title'] }}</h3>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <form class="form-inline" style="display: inline-block" action="{{ action('PostController@search') }}">
                    <input name="s" autocomplete="off" data-provide="typeahead" source="[123,321,252]" type="text" class="input-sm form-control">
                    <input type="submit" value="search">
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="text-right">
                <a class="btn btn-default btn-primary" href="{{ action('PostController@create') }}">发表</a>
            </div>
        </div>
        <div class="col-md-12">
            <section>
                <ul>
                    @foreach($posts as $post)
                        <li><a href="{{ action('PostController@show',$post->id) }}">{{$post -> title}}</a></li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
    {!! $posts->render() !!}
@endsection