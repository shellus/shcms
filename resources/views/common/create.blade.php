@extends('layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">新增</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>哎呀！</strong> 您的输入有一些问题。<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


                        <form class="form-horizontal" role="form" method="POST" action="{{ $submit_url }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @foreach($columns as $column)
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{ trans('validation.attributes.' . $column) }}({{ $column }})</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="{{ $column }}" value="{{ old($column) }}">
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">{{ trans('validation.submit_title') }}</button>
                                </div>
                            </div>
                        </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
