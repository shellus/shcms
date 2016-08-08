@extends('layout')
@title('商品列表')
@section('head')
    <style>

        .search-box>input{
            border-radius: 0 !important;
        }
        .search-box>.input-group-btn>.btn{
            border-radius: 0;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="GET" action="{{ route('goods.index') }}">
                    <div class="input-group input-group-lg search-box">
                        <input type="text" class="form-control" name="s" value="{{ request('s') }}" placeholder="大家都在搜 手机">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">搜索</button>
                      </span>
                    </div>
                </form>
            </div>
        </div>
        <hr>
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
