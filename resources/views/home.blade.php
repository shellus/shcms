@extends('layouts.app')

@section('header')
<style>
    .reading-time{
        width: 8em;
        display: inline-block;
    }
</style>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">个人信息</div>

                <div class="panel-body">

                    <h3>我的数据：</h3>
                    <div class="row">
                        <div class="col-xs-3">
                            <span>阅读量: </span>
                            <span>{{ $read_count }}</span>
                        </div>
                        <div class="col-xs-3">
                            <span>阅读时长: </span>
                            <span>{{ $read_time }} 秒</span>
                        </div>
                    </div>

                    <h3>最近阅读：</h3>
                    <ul id="articles" class="list-unstyled">
                        @foreach($lest_read_articles as $lest_read_article)
                            <li>
                                <span class="label label-info reading-time">{{ \Carbon\Carbon::parse($lest_read_article -> created_at) -> diffForHumans() }}</span>

                                <span class="label label-info reading-time">阅读 {{ $lest_read_article -> reading_at }} 秒</span>
                                <a href="{{ $lest_read_article -> article -> showUrl() }}">
                                    {{ $lest_read_article -> article -> title }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <div class="panel-footer">
                    {!! $lest_read_articles->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
