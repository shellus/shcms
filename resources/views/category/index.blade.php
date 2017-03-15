@extends('layouts.app')
@section('header')
    <style>
        #articles{
            line-height: 2em;
            min-height: 400px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">分类</div>

                    <div class="panel-body">
                        <script type="application/html" id="articles-tmpl">
                            <li>
                                <a href="{url}">{title}</a>
                            </li>
                        </script>
                        <ul id="articles" class="list-inline">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ $category -> showUrl() }}">
                                    <img width="64" height="64" src="{{ $category->logoUrl }}" class="img-circle">
                                        <div class="text-center">
                                            {{ $category['title'] }}({{ $category['articles_count'] }})
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection