@extends('layouts.content')
@section('header')
    <style>
        #article-field-set {
            font-style: oblique;
            font-size: 0.9em;
            margin: 18px 18px 18px 0;
            border-left: 2px solid #1b6d85;
        }

        .btn-vote {
            padding: 0;
        }
    </style>
    <meta name="article-id" content="{{ $article -> id }}">
@endsection
@section('body')
    <div class="col-md-8 col-md-offset-0">
        <div class="app-block">
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
                <span>长度: </span>
                <span>{{ mb_strlen($article -> body) }} 字</span>
            </div>
            <div class="col-xs-4">
                <span hidden>标签: </span>
                <ul class="tags list-inline">
                    @foreach($article->tags as $tag)
                        <li>
                            <a href="{{ $tag->showUrl() }}">
                                    <span class="label label-success">
                                        {{ $tag->title }}
                                    </span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row action-list">

            <div class="col-md-6">
                @if(\Auth::check() && \Auth::user()->can('manage_contents'))
                    <div>
                        <form class="form-inline" action="{{ route('article.destroy', $article -> id) }}"
                              method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a class="btn btn-link" href="{{ route('article.edit', $article -> id) }}">编辑</a>
                            <button class="btn btn-link">删除</button>
                            {{ return_url_field(route('article.index')) }}
                        </form>

                    </div>
                @endif

            </div>
        </div>


        <section id="article-body">
            {!! $article -> body !!}
        </section>
        <div class="article-author">
            <a href="#">
                <img style="padding: 5px;" class="img-circle" width="50" height="50"
                     src="{{ $article->user->avatarUrl }}">
                {{ $article->user->name }}</a>
            <small>{{ $article->created_at->diffForHumans() }} 发布</small>
        </div>
        <hr>
        <ul class="comments list-unstyled">
            @foreach($article['comments'] as $comment)

                <li style="border-bottom: darkcyan solid 1px;">

                    <section style="padding: 10px;">
                        {!! $comment->body !!}
                    </section>
                    <div class="author">
                        <a href="#">
                            <img style="padding: 5px;" class="img-circle" width="50" height="50"
                                 src="{{ $comment->user->avatarUrl }}">
                            {{ $comment->user->name }}</a>
                        <small>{{ $comment->created_at->diffForHumans() }} 回复</small>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="goto-comment-editor">
            <h4>回复</h4>
            <form id="comment-editor" method="post" action="{{ route('article.comment.store', $article) }}">
                @include('hacker_alert')
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="hidden" for="field-body"></label>
                    @if(\Auth::check())
                        <textarea id="field-body" style="height: 120px;resize:none;" class="form-control"
                                  name="body"></textarea>
                    @else
                        <div id="field-body" style="height: 120px;" class="form-control" name="body">登陆后才可以回复哦
                        </div>
                    @endif
                </div>

                <button>提交</button>
            </form>
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
    </div>
@endsection


@section('footer')
    {{--// todo 这里为啥要Ajax？？？？--}}
    <script>
        $(document).on('submit', '#comment-editor', function (event) {
            var form = $(event.target);
            var url = form.attr('action');
            var method = form.attr('method');
            var request_data = form.serializeArray();
            $.ajax(url, {
                type: method,
                dataType: 'json',
                data: request_data,
            }).always(function (xhrOrData, status) {
                var response_data = [];
                if (status == 'success') {
                    response_data = xhrOrData;
                } else {
                    response_data = xhrOrData.responseJSON;
                }
                alert(response_data.message);
                if (response_data.status == 'success') {
                    location.reload();
                }
            });
            return false;
        })
    </script>
    <script>

        var currentUserVote = $('#VoteBar').data('currentUserVote');

        renderVote(currentUserVote);

        function renderVote() {

            if (window.currentUserVote > 0) {
                $('#vote-down-btn').removeClass('active');
                $('#vote-up-btn').addClass('active');
            } else if (window.currentUserVote === 0) {
                $('#vote-up-btn').removeClass('active');
                $('#vote-down-btn').removeClass('active');
            } else if (window.currentUserVote < 0) {
                $('#vote-down-btn').addClass('active');
                $('#vote-up-btn').removeClass('active');
            }
        }

        function vote_click(event, self, is_add) {
            $(self).attr("disabled", true);
            event.preventDefault();
            if (is_add) {
                var url = '{{ url('/article/vote') }}';
                var data = {!! json_encode(['article_id'=>$article -> id, 'action' => 'up', '_token' => csrf_token()]) !!};
            } else {
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

        var ishttps = 'https:' == document.location.protocol ? true : false;

        if (ishttps) {
            var conn = new WebSocket('wss://' + document.domain + '/websocket');
        } else {
            var conn = new WebSocket('ws://' + document.domain + ':8080');
        }

        conn.onopen = function (e) {
            console.log('websocket 连接成功');
        };

        conn.onmessage = function (e) {
            console.log(e.data);
        };
        // 统计阅读时间


        $(function () {

            // 上次滚动条位置
            var last_height = -1;

            setInterval(function () {

                // 如果滚动条没变
                if (document.scrollingElement.scrollTop === last_height) {

                    // 说明他还在看
                    sleep++;
                } else {

                    // 否则他已经往下看了
                    sleep = 0;
                }

                // 记录滚动条位置
                last_height = document.scrollingElement.scrollTop;


                // 5秒看一屏，是正常看的
                if (sleep < 5) {
                    conn.send(JSON.stringify({
                        'article_id': $('meta[name="article-id"]').attr('content'),
                    }));
                } else {
                    // 否则是他没看了，在挂机
                    console.log('挂机，不统计');
                }
            }, 1000)
        });


    </script>
@endsection