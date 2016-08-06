@extends('layout')
@section('head')
    <style>

        .goods-images-box img{
            max-width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="GET" action="{{ route('goods.index') }}">
                    <div class="input-group input-group-lg search-box">
                        <input type="text" class="form-control" name="s" value="{{ request('s') }}" placeholder="大家都在搜 路由器">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">搜索</button>
                      </span>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">

            <div class="col-sm-4 goods-images-box">
                <img src="{{ $model -> files -> first() -> showUrl() }}" alt="...">
            </div>
            <div class="col-sm-6">
                <h5>{{ $model->title }}</h5>
                <ul>
                    <li>原价：{{ $model -> price }}</li>
                    <li>现价：{{ $model -> discount_price }}</li>
                    <li>已售：{{ $model -> current_sell_out }}</li>
                </ul>
                <ul>
                    @foreach($model -> goods_spec_types as $spec_type)
                    <li>
                        {{ $spec_type -> title }}:
                        <ul class="list-inline" style="display: inline">
                            @foreach($spec_type -> goods_specs as $spec)
                                <li>
                                    <label class="radio-inline">
                                        <input type="radio" name="spec_type_{{ $spec_type -> id }}" id="spec_{{ $spec -> id }}" value="spec_{{ $spec -> id }}"> {{ $spec -> title }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
                <ul class="list-inline">
                    <li>
                        <form method="post" action="{{ route('shop_cart.store') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="goods_id" value="{{ $model->id }}">
                            <input type="number" name="quantity" value="1">

                            <button type="submit" class="btn btn-primary btn-lg">加入购物车</button>
                        </form>

                    </li>
                    <li>
                        <button type="button" class="btn btn-primary btn-lg">立即购买</button>
                    </li>
                </ul>
            </div>





        </div>
    </div>
@endsection
