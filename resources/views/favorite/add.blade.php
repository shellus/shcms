    <div class="modal-content">
        <ul>
            @foreach($favorite_directories as $favorite_directory)
                <li>{{ $favorite_directory -> title }}</li>
            @endforeach
        </ul>
    </div>

