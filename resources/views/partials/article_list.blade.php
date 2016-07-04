<ul>
    @foreach($articles as $article)
    <li>
        <a href="{{ $article -> getRouteUrl() }}">
            {{ $article -> title }}
        </a>
    </li>
    @endforeach
</ul>