@extends('layouts.app')
@section('header')
    <style>
        #article-field-set{
            font-style: oblique;
            font-size: 0.9em;
            margin: 18px 18px 18px 0;
            border-left: 2px solid #1b6d85;
        }
    </style>
    <meta name="article-id" content="{{ $article -> id }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>{{ $article -> title }}</h2>

                <div class="row" id="article-field-set">
                    <div class="col-xs-3">
                        <span>分类: </span>
                        <span>武侠古典</span>
                    </div>
                    <div class="col-xs-3">
                        <span>阅读数量: </span>
                        <span>103</span>
                    </div>
                    <div class="col-xs-3">
                        <span>长度: </span>
                        <span>{{ strlen($article -> body) }} 字</span>
                    </div>
                </div>

                <div class="action-list">
                    <a href="{{ route('article.edit', $article -> id) }}">编辑</a>
                </div>
                <hr>



                <div id="article-body">
                    {{--　　--}}
                    {!! $article -> body !!}
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


@section('footer')
    <script>
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);
        };
        // 统计阅读时间
        /*
        $(function () {

            // 上次滚动条位置
            var last_height = -1;

            setInterval(function () {

                // 如果滚动条没变
                if(document.scrollingElement.scrollTop === last_height){

                    // 说明他还在看
                    sleep++;
                }else {

                    // 否则他已经往下看了
                    sleep = 0;
                }

                // 记录滚动条位置
                last_height = document.scrollingElement.scrollTop;


                // 5秒看一屏，是正常看的
                if(sleep < 5){
                    $.ajax('/article/reading', {
                        data:{
                            'article_id': $('meta[name="article-id"]').attr('content'),
                        },
                        success: function (data) {
                            console.log(data);
                        }
                    });
                }else {
                    // 否则是他没看了，在挂机
                    console.log('挂机，不统计');
                }
            }, 1000)
        });
        */

    </script>
@endsection