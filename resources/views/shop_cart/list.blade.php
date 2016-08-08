@extends('layout')
@section('head')
    <style>
        .shop-cart-list>li{
            margin-bottom: 10px;
        }
    </style>
    @endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $title }}</div>
				<div class="panel-body">
                    <ul class="shop-cart-list list-unstyled">
                    @foreach ($models as $model)
                        <li>
                            <div class="media">
                                <div class="media-left">
                                    <a href="{{ $model -> goods -> showUrl() }}">
                                        <img width="100" height="100" src="{{ $model -> goods -> files -> first() -> showUrl() }}" alt="...">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="media-heading">{{ $model -> goods ->title }}</h4>
                                            <ul>
                                                <li>现价：{{ $model -> goods -> discount_price }}</li>
                                                <li>数量：<input type="number" name="quantity" value="{{ $model -> quantity }}"> </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul>
                                                <li>
                                                    <form method="post" action="{{ route('shop_cart.destroy',$model) }}">
                                                        {{ method_field('DELETE') }}
                                                        {!! csrf_field() !!}
                                                        <input type="hidden" name="goods_id" value="{{ $model->id }}">
                                                        <button type="submit" class="btn btn-link">删除</button>
                                                    </form>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                    @endforeach
                    </ul>
				</div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">结算</button>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
