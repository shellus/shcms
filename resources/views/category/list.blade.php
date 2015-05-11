@extends('layout')

@section('content')
    <div class="row">

        <div class="col-md-6">
            <h3>全部分类</h3>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <form class="form-inline" style="display: inline-block" action="{{ action('PostController@search') }}">
                    <input name="s">
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
                <ul id="categorys">
                    @foreach($categorys as $category)
                        <li><a href="{{ action('PostController@category',$category->id) }}">{{ $category -> title }}</a>({{ $category -> postCount() }})</li>
                    @endforeach
                </ul>
            </section>
        </div>
    </div>
@endsection