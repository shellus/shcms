@extends('layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">详情</div>
				<div class="panel-body">
                    {{ dump($model -> toArray()) }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
