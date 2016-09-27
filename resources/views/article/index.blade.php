@extends('layouts.app')
@section('header')
    <style>
        .panel-footer {
            padding: 10px 15px;
            background-color: inherit;
        }
        .pagination {
            margin: 10px 0;
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

                        <ul id="articles" class="list-unstyled">
                            @foreach($articles as $article)
                                <li>
                                    <a href="{{ $article -> showUrl() }}">{{ $article['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        {!! $articles->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
    </script>
@endsection