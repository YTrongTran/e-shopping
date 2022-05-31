
@foreach ($blogcmts as $blogcmt )

    <li class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{ asset($blogcmt->user->avatar_path) }}" alt="">
        </a>
        <div class="media-body">
            <ul class="sinlge-post-meta">
                <li><i class="fa fa-user"></i>{{ $blogcmt->user->name }}</li>
                <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($blogcmt->created_at)) }} pm</li>
                <li><i class="fa fa-calendar"></i> {{ date('M d'.','.' Y', strtotime($blogcmt->created_at)) }}</li>
            </ul>
            <p>{{ $blogcmt->cmt }}</p>
            <a class="btn btn-primary reply_comment" data-id="{{$blogcmt->id  }}" ><i class="fa fa-reply"></i>Replay</a>
        </div>
    </li>

      <form action="" method="POST" style="display:none" class="formReply reply-{{ $blogcmt->id }}" >
            <div class="blank-arrow">
                <label>Your Name</label>
            </div>
            <span>*</span>
            <textarea id="message-{{ $blogcmt->id }}" rows="5" class="textarea_message"></textarea>
            <button type="submit"  data-id="{{ $blogcmt->id  }}" class="btn btn-primary reply_comment_form">post comment</button>
        </form>

    @if($blogcmt->childsBlog->count() > 0)
        @foreach ( $blogcmt->childsBlog as $childs )
        {{-- comment con --}}
        <li class="media second-media">
            <a class="pull-left" href="#">
                <img class="media-object" src="{{ asset($childs->user->avatar_path)}}" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{ $childs->user->name }}</li>
                    <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($childs->created_at)) }} pm</li>
                    <li><i class="fa fa-calendar"></i> {{ date('M d'.','.' Y', strtotime($childs->created_at)) }}</li>
                </ul>
                <p>{{ $childs->cmt }}</p>
            </div>
        </li>
        @endforeach
    @endif
@endforeach


