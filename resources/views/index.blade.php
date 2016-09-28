@extends('layouts.app')
@section('header')
    <style>
        #articles{
            line-height: 2em;
        }
        body{
            background-image: url("/images/index.jpg");
            background-size: cover;
        }
        .navbar-default {
            background-color: rgba(248, 248, 248, 0.6);
        }
        .panel {
            background-color: rgba(255, 255, 255, 0.28);
        }
    </style>
@endsection
@section('content')
    <div class="container">


        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel">
                    <div class="panel-body">
                        <form method="GET" action="{{ url('/article/search') }}">
                            <div class="input-group input-group-lg search-box">
                                {{--<input type="hidden" name="c" value="*">--}}
                                <input type="text" class="form-control" name="s" value="{{ \Request::get('s') }}" placeholder="大家都在搜 丝袜">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">搜索</button>
                                  </span>
                            </div>
                        </form>

                        <script type="application/html" id="articles-tmpl">
                            <li>
                                <a href="{url}">{title}</a>
                            </li>
                        </script>
                        <ul id="articles" class="list-unstyled">
                            @foreach($articles as $article)
                                <li>
                                    <a href="{{ $article -> showUrl() }}">{{ $article['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
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