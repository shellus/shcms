@extends('layouts.app')

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
                        @foreach($lest_read_articles as $article)
                            <li>
                                <a href="{{ $article -> article -> showUrl() }}">
                                    {{ $article -> article -> title }}</a>
                                || 读了 {{ $article -> reading_at }} 秒
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
