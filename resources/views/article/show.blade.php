@extends('layouts.app')
@section('header')
    <style>
        #article-body{
            line-height: 2em;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $article -> title }}</div>

                    <div class="panel-body">
                        <div id="article-body">
                            　　{!! $article -> body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6 text-right">
                        下一篇：<a href="{{ $article -> next() -> showUrl() }}">{{ $article -> next() -> title }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection