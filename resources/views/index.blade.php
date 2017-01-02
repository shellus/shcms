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
                                <input id="search-input" autocomplete="off" type="search" class="form-control es-input" name="s"
                                       value="{{ \Request::get('s') }}" placeholder="双击查看热搜词哦">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">搜索</button>
                                  </span>
                            </div>

                            <ul style="background-color: #1f648b;" class="input-datalist list-unstyled" id="word-list"
                                hidden>
                                @foreach($search_histories as $search_history)
                                    <li value="{{ $search_history -> word }}">
                                        {{ $search_history -> word }} 热搜 {{ $search_history -> rows }} 次
                                    </li>
                                @endforeach
                            </ul>


                            <div class="col-md-7" id="fade-place" data-effects="fade">
                                <input type="text"
                                       autocomplete="off"
                                       class="form-control es-input">
                                <ul class="es-list" style="top: 33px; left: 15px; width: 273px; display: none;">
                                    <li class="" style="display: none;">Alfa Romeo</li>
                                    <li class="" style="display: none;">Audi</li>
                                    <li class="" style="display: none;">BMW</li>
                                    <li class="" style="display: none;">Citroen</li>
                                    <li class="" style="display: none;">Fiat</li>
                                    <li class="" style="display: none;">Ford</li>
                                    <li class="" style="display: none;">Jaguar</li>
                                    <li class="es-visible selected">Jeep</li>
                                    <li class="" style="display: none;">Lancia</li>
                                    <li class="" style="display: none;">Land Rover</li>
                                    <li class="" style="display: none;">Mercedes</li>
                                    <li class="" style="display: none;">Mini</li>
                                    <li class="" style="display: none;">Nissan</li>
                                    <li class="" style="display: none;">Opel</li>
                                    <li class="" style="display: none;">Peugeot</li>
                                    <li class="" style="display: none;">Porsche</li>
                                    <li class="" style="display: none;">Renault</li>
                                    <li class="" style="display: none;">Smart</li>
                                    <li class="" style="display: none;">Volkswagen</li>
                                    <li class="" style="display: none;">Volvo</li>
                                </ul>
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
                    <div class="text-center">
                        <a style="" class="btn btn-primary btn-lg" href="{{ url('/') }}">再来一波</a>
                    </div>
                    {{--<searchbox>123</searchbox> TODO 写Vue的搜索下拉框 --}}
                    <br>
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