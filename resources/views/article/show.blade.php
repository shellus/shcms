@extends('layouts.app')
@section('header')
    <style>
        #article-body{
            line-height: 2em;
        }
        .panel-body {
            padding-top: 0;
        }
        #article-field-set{
            font-style: oblique;
            padding: 10px;
        }
    </style>
    <meta name="article-id" content="{{ $article -> id }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $article -> title }}</div>

                    <div class="panel-body">
                        <div class="row bg-info" id="article-field-set">
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


@section('footer')
    <script>
        // 统计阅读时间
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


                // 20秒看一屏，是正常看的
                if(sleep < 20){
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
    </script>
@endsection