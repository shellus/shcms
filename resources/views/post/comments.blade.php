@foreach($comments as $comment)


    <div class="comment" id="comment_{{ $comment -> id }}" data-comment-id="{{ $comment -> id }}"
        data-comment-parent-id="{{ $comment -> parent_id }}">
        <div class="comment-user">
            <img src="{{ $comment -> user ->getAvatarUrl() }}" width="50" height="50" class="img-circle">
        </div>
        <div class="comment-content">
            <div class="text">
                {{ $comment -> content }}
            </div>

        </div>
        {{--<span class="username">{{ $comment -> user -> name }}</span> 在 <span class="comment-time">{{ tmspan($comment -> created_at) }}</span>--}}
        {{--<p class="comment-title" hidden="">--}}
            {{--<b>{{ $comment -> title }}</b>--}}
        {{--</p>--}}
        {{--<div class="col-xs-6">--}}
            {{--<p class="comment_controller text-right">--}}
                {{--<a href="#" class="comment-in-link">回复</a>--}}
            {{--</p>--}}
        {{--</div>--}}




        <div class="comment-child">
            <ul class="list-unstyled">
                @if($comments = $comment -> child)
                    @include('post.comments', ['comments' => $comments])
                @endif
            </ul>
        </div>
    </div>
@endforeach