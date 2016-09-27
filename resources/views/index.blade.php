@extends('layouts.app')
@section('header')
    <style>
        #articles{
            line-height: 2em;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">无穷无尽，请随心点击</div>

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