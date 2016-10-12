<form action="{{ route('add-article-to-favorite') }}" method="POST">

    {{ csrf_field() }}
    <input type="hidden" name="article_id" value="{{ Request::get('article_id') }}">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">选择一个收藏夹</h4>
    </div>
    <div class="modal-body">

        <ul class="list-group">
            @foreach($favorite_directories as $favorite_directory)
                <li class="list-group-item">
                    <label>
                        <input type="radio" name="favorite_directory_id" value="{{ $favorite_directory -> id }}" title="{{ $favorite_directory -> title }}">
                        {{ $favorite_directory -> title }}
                    </label>
                </li>
            @endforeach
        </ul>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary" id="save-to-favorite">保存</button>
    </div>

</form>

<script>
    $('#save-to-favorite').click(function(){

    });
</script>