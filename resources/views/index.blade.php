@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-body">
                        <form method="GET" action="{{ url('/article/search') }}">
                            <div class="input-group input-group-lg search-box">
                                {{--<input type="hidden" name="c" value="*">--}}
                                <input autocomplete="off" list="word_list" type="search" class="form-control" name="s" value="{{ \Request::get('s') }}" placeholder="双击查看热搜词哦">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">搜索</button>
                                  </span>
                            </div>

                            <datalist id="word_list">
                                @foreach($search_histories as $search_history)
                                <option label="{{ $search_history -> word }} 热搜 {{ $search_history -> rows }} 次" value="{{ $search_history -> word }}" />
                                @endforeach
                            </datalist>

                        </form>

                        <script type="application/html" id="articles-tmpl">
                            <li>
                                <a href="{url}">{title}</a>
                            </li>
                        </script>
                        <ul id="articles" class="list-unstyled">
                            @foreach($articles as $article)
                                <li>
                                    <div>
                                        <h3>{{ $article -> display_title }}</h3>
                                    </div>
                                    <div>
                                        {!! trim(strip_tags(mb_substr($article -> body,0,120))) !!}
                                    </div>
                                    <a title="{{ $article -> title }}" href="{{ $article -> showUrl() }}">阅读全文</a>
                                    <hr>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <a style="width: 100%; padding: 20px 10px" class="btn btn-primary btn-lg" href="{{ url('/') }}">再来一波</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
//        $(function () {
//            var articles = [];
//            fetch(function () {
//                setInterval(function () {
//                    var article = articles.shift();
//
//                    if(articles.length < 5){
//                        fetch(function(){console.log('又拉来一批')});
//                    }
//                    var url = 'http://shcms-v3.localhost/article/' + article.id;
//                    var title = article.title;
//                    var html = $("#articles-tmpl").html();
//                    var el = html.replace('{url}', url).replace('{title}', title)
//                    $('#articles').append(el);
//                    $('#articles').scrollTop( $('#articles')[0].scrollHeight);
//                }, 100)
//            });
//
//            function fetch(callback) {
//                $.ajax('/api/article', {
//                    success: function (data) {
//                        articles = articles.concat(data);
//                        callback();
//                    }
//                });
//            }
//        });
    </script>
@endsection