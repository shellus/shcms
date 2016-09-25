@extends('layouts.app')
@section('header')
    <style>
        #articles{
            line-height: 2em;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">无穷无尽，请随心点击</div>

                    <div class="panel-body">
                        <ul id="articles">
                        @foreach($articles as $article)
                            <li>
                                <a href="{{ $article -> showUrl() }}">{{ $article['title'] }} length {{ strlen($article['body']) }}</a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @foreach(getQueryLog() as $query)
        <pre>
            {{ $query['sql'] }} in {{ $query['time'] }}
        </pre>
    @endforeach
@endsection