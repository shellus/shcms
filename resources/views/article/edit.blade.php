@extends('layouts.app')
@section('header')
    <style>
        .form-control {
            background-color: rgba(255, 255, 255, 0.12);
            height: inherit;
        }
    </style>
    <meta name="article-id" content="{{ $article -> id }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">

                <form class="form-horizontal" role="form" method="POST" action="{{ route('article.update', $article -> id) }}"
                      onsubmit="document.getElementById('body-input').value = document.getElementById('body-div').innerHTML;">

                    <div class="col-md-8 col-md-offset-2">
                        {{ csrf_field() }}
                        {!! method_field('put') !!}
                        <div class="form-group">
                            <input id="title" type="text" class="form-control" name="email" value="{{ $article -> title }}">
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
                            <textarea id="body-input" name="body" hidden></textarea>
                            <div id="body-div" class="form-control" contenteditable="true">{!! $article -> body !!}</div>
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
    <script>
    </script>
@endsection