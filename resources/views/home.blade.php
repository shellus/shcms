@extends('layouts.app')

@section('header')
    <style>
        .reading-time {
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
                        <span><b>{{ \Auth::user() -> name }}</b></span>

                        <form action="/user/update-avatar" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <span>头像: </span>
                            <span><img style="padding: 15px;" class="img-circle" width="100" height="100" src="{{ \Auth::user() -> avatarUrl }}"></span>
                            <input name="avatar" type="file" value="选择文件">
                            <input type="submit" value="上传">
                        </form>

                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">我的阅读</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <span>阅读量: </span>
                                <span>{{ $read_count }}</span>
                            </div>
                            <div class="col-xs-3">
                                <span>阅读时长: </span>
                                <span>{{ \Carbon\Carbon::createFromTimestamp(0) -> diffForHumans(\Carbon\Carbon::createFromTimestamp($read_time), true) }}</span>
                            </div>
                        </div>

                        <h3>最近阅读：</h3>
                        <ul id="articles" class="list-unstyled">


                            @forelse($lest_read_articles as $lest_read_article)
                                <li>
                                    <span class="label label-info reading-time">{{ \Carbon\Carbon::parse($lest_read_article -> created_at) -> diffForHumans() }}</span>

                                    <span class="label label-info reading-time">阅读 {{ \Carbon\Carbon::createFromTimestamp(0) -> diffForHumans(\Carbon\Carbon::createFromTimestamp($lest_read_article -> reading_at), true) }}</span>
                                    <a href="{{ $lest_read_article -> article -> showUrl() }}">
                                        {{ $lest_read_article -> article -> title }}</a>
                                </li>
                            @empty
                                <p>还没看过任何文章哦</p>
                                <img src="{{ asset('/images/not-content.jpg') }}">
                            @endforelse
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
