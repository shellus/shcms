<ul>
    @foreach($articles as $article)
    <li>
        <a href="{{ $article -> showUrl() }}">
            {{ $article -> title }}
        </a>
    </li>
    @endforeach
</ul>