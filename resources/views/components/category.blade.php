<ul class="">
    @foreach($categories as $category)
        <li>
            <a href="{{ $category -> showUrl() }}">
                <img width="20" height="20" src="{{ $category->logoUrl }}" class="img-circle">
                {{ $category['title'] }}
            </a>
        </li>
    @endforeach
</ul>