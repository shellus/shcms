@extends('layout')
@section('head')
    <title>{{ config('system.site_title') }} - {{ $title }}</title>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            @foreach ($models as $model)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="{{ $model->showUrl() }}">
                            <img src="{{ $model -> files -> first() -> showUrl() }}" alt="...">
                        </a>
                        <div class="caption">
                            <h5><a href="{{ $model->showUrl() }}">{{ $model->title }}</a></h5>
                            <ul>
                                <li>原价：{{ $model -> price }}</li>
                                <li>现价：{{ $model -> discount_price }}</li>
                                <li>已售：{{ $model -> current_sell_out }}</li>

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {!! $models -> render() !!}
    </div>
@endsection
