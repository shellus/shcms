@extends('layout')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">列表</div>
				<div class="panel-body">
                    <div class="article-list">
                        @include('partials.article_list',['articles' => $models])
                    </div>
				</div>
                <div class="text-center">
                    {!! $models -> render() !!}
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
