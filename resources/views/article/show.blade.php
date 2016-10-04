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
                        <span>
                            <a href="{{ $article -> category() -> showUrl() }}">
                            {{ $article -> category() -> title }}
                            </a>
                        </span>
                    </div>
                    <div class="col-xs-3">
                        <span>阅读数量: </span>
                        <span>{{ $article -> readingHistories() -> count() }}</span>
                    </div>
                    <div class="col-xs-3">
                        <span>长度: </span>
                        <span>{{ mb_strlen($article -> body) }} 字</span>
                    </div>
                </div>

                <div class="row action-list">



                    <div class="col-md-6">
                        <div class="zm-votebar goog-scrollfloater" data-za-module="VoteBar">
                            <div>

                                <button title="喜欢的文章，就给它11个赞吧~" id="vote-up-btn" href="#" class="btn btn-default" onclick="vote_click(event, this, 1);">
                                    <i class="glyphicon glyphicon-thumbs-up text-success"></i>
                                    赞(<span id="vote-up-count">{{ $article -> votes() -> where('vote', '>', 0) -> sum('vote') }}</span>)
                                </button>

                            </div>
                            <div>
                                <button id="vote-down-btn" href="#" class="btn btn-default" onclick="vote_click(event, this, 0);">
                                    <i class="glyphicon glyphicon-thumbs-down text-warning"></i>
                                    踩(<span id="vote-down-count">{{ $article -> votes() -> where('vote', '<', 0) -> sum('vote') }}</span>)
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div>
                            <a data-toggle="modal" data-target="#modal" href="{{ url('/favorite/add') }}">收藏</a>
                            <div id="modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-sm"></div>
                            </div>
                        </div>
                        <div>
                            @if(\Auth::user()->can('manage_contents'))
                                <a href="{{ route('article.edit', $article -> id) }}">编辑</a>
                                <a href="{{ route('article.edit', $article -> id) }}">删除</a>
                            @endif
                        </div>
                    </div>
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
                        上一篇：
                        @if($article -> previous())
                            <a href="{{ $article -> previous() -> showUrl() }}">{{ $article -> previous() -> title }}</a>
                        @else
                            没有了
                        @endif


                    </div>
                    <div class="col-xs-6 text-right">
                        下一篇：
                        @if($article -> next())
                            <a href="{{ $article -> next() -> showUrl() }}">{{ $article -> next() -> title }}</a>
                        @else
                            没有了
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('footer')
    <script>

        var currentUserVote = {{ $article -> currentUserVote() }};

        renderVote(currentUserVote);

        function renderVote() {

            if (window.currentUserVote > 0){
                $('#vote-down-btn').removeClass('active');
                $('#vote-up-btn').addClass('active');
            }else if (window.currentUserVote === 0){
                $('#vote-up-btn').removeClass('active');
                $('#vote-down-btn').removeClass('active');
            }else if (window.currentUserVote < 0){
                $('#vote-down-btn').addClass('active');
                $('#vote-up-btn').removeClass('active');
            }
        }

        function vote_click(event,self,is_add) {
            $(self).attr("disabled", true);
            event.preventDefault();
            if(is_add){
                var url = '{{ url('/article/vote') }}';
                var data = {!! json_encode(['article_id'=>$article -> id, 'action' => 'up', '_token' => csrf_token()]) !!};
            }else {
                var url = '{{ url('/article/vote') }}';
                var data = {!! json_encode(['article_id'=>$article -> id, 'action' => 'down', '_token' => csrf_token()]) !!};
            }

            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: url,
                data: JSON.stringify(data),
                success: function (data) {
                    window.currentUserVote = data.data.vote;
                    renderVote();
                    $('#vote-up-count').html(data.data.article_up_vote);
                    $('#vote-down-count').html(data.data.article_down_vote);
                    $(self).attr("disabled", false);
                    console.log(data)
                },
                error: function (err) {
                    renderVote(data.data.vote);
                    $(self).attr("disabled", false);
                }
            });

        }


        var conn = new WebSocket('ws://'+document.domain+':8080');
        conn.onopen = function(e) {
            console.log('websocket 连接成功');
        };

        conn.onmessage = function(e) {
            console.log(e.data);
        };
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


                // 5秒看一屏，是正常看的
                if(sleep < 5){
                    conn.send(JSON.stringify({
                        'article_id': $('meta[name="article-id"]').attr('content'),
                    }));
                }else {
                    // 否则是他没看了，在挂机
                    console.log('挂机，不统计');
                }
            }, 1000)
        });


    </script>
@endsection