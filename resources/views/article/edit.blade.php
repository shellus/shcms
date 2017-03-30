@extends('layouts.app')
@section('header')

    <link rel="stylesheet" href="/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css">
    <style>
        .form-control {
            background-color: rgba(255, 255, 255, 0.12);
            height: inherit;
        }
    </style>
    <meta name="article-id" content="{{ $article->id }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <form class="form-horizontal" role="form" method="POST" action="{{ route($route, $article->id) }}">

                <div class="col-md-8 col-md-offset-2">
                    {{ csrf_field() }}
                    {!! method_field($method) !!}
                    <div class="form-group">
                        <input id="title" type="text" class="form-control" name="title" value="{{ $article->title }}">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">

                            </div>
                            <div class="col-xs-6 text-right">
                                <input class="btn btn-default" type="submit" value="保存">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea style="width: 100%; height: 200px; font-size: 14px; line-height: 18px;" id="body-input" name="body" hidden>{{ $article->body }}</textarea>
                    </div>
                    <hr>
                </div>


                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-xs-6">

                        </div>
                        <div class="col-xs-6 text-right">
                            <input class="btn btn-default" type="submit" value="保存">
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>
@endsection


@section('footer')
    <script src="/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
        $('#body-input').wysihtml5({
            toolbar: {
                fa: true
            }
        }).show();
    </script>
    <script>
    </script>
@endsection