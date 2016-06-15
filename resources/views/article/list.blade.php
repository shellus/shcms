@extends('layout')
@section('head')
    <title>{{ config('system.site_title') }} - {{ $title }}</title>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">列表</div>
				<div class="panel-body">
                    <ul>
                    @foreach ($model as $article)
                        <li><a href="{{ $article->showUrl() }}">{{ $article->title }}</a></li>
                    @endforeach
                    </ul>
				</div>
                {!! $model -> render() !!}
			</div>
		</div>
	</div>
</div>
@endsection
