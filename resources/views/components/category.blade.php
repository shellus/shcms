<ul class="">
    @foreach($categories as $category)
        <li>
            <a href="{{ $category -> showUrl() }}">
                <img width="20" height="20" src="{{ $category->logoUrl }}" class="img-circle">
                {{ $category['title'] }}({{ ($category['articles_count']) }})
            </a>
        </li>
    @endforeach
</ul>