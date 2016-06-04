<div class="col-md-2 bs-sidebar">
    <ul class="nav bs-sidenav">
        @foreach (\App\Lottery::where(['title' => '时时彩']) -> get() as $lottery)
            <a href="{{ action('Game\ShishicaiController@show',$lottery->name) }}">
                <li>{{ $lottery->province }}时时彩<i class="glyphicon glyphicon-chevron-right pull-right"></i></li>
            </a>
        @endforeach
    </ul>

</div>