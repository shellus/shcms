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