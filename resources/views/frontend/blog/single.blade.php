
@extends('frontend.layouts.master')
@section('title')
    <title>Blog | E-Shopper</title>
@endsection

@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('rate/css/rate.css') }}">
@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.container.left-sidebar')

                <div class="col-sm-9 padding-right">
                        <div class="blog-post-area">
                            <h2 class="title text-center">Latest From our Blog</h2>
                            <div class="single-blog-post">
                                <h3>{{ $blogId->name }}</h3>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> {{ $blogId->user->name }}</li>
                                        <li><i class="fa fa-clock-o"></i> {{ date('H:i', strtotime($blogId->created_at)) }} pm</li>
                                        <li><i class="fa fa-calendar"></i> {{ date('M d '.','.'Y', strtotime($blogId->created_at)) }}</li>
                                    </ul>
                                    <span>
                                        <div class="rate">
                                            <div class="vote">
                                               @for ($i = 1 ; $i <=5 ;  $i++ )
                                               <div class="star_{{ $i }} ratings_stars {{ (trim($gpa) >= trim($i))? "ratings_over": " " }}" ></div>
                                               @endfor
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <a href="">
                                    <img src="{{ asset($blogId->image_path) }}" style="object-fit: cover" alt="">
                                </a>
                                <p>
                                    {!! $blogId->description !!}
                                </p>
                                <div class="pager-area">
                                    <ul class="pager pull-right">
                                        <li>
                                            @if ($previous)
                                            <a href="{{ route('frontend.blog.show',['slug'=>$previous['display_name'],'id'=> $previous['id']]) }}">Pre</a>
                                            @endif
                                        </li>

                                        <li>
                                            @if ($next)
                                            <a href="{{ route('frontend.blog.show',['slug'=>$next['display_name'],'id'=> $next['id']]) }}">Next</a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <form  method="get" data-url="{{ route('frontend.blog.show',['slug'=> $blogId['display_name'], 'id'=>$blogId['id']]) }}" id="form_url">
                            @csrf
                            <div class="rate">
                                <div class="vote">
                                   @for ($i = 1 ; $i <=5 ;  $i++ )
                                   <div class="star_{{ $i }} ratings_stars {{ (trim($gpa) >= trim($i))? "ratings_over": " " }}" ><input value="{{ $i }}" type="hidden"></div>
                                   @endfor
                                   <span class="rate-np">{{ $gpa }}</span>
                                </div>
                            </div>
                        </form>
                        <div class="socials-share">
                            <a href=""><img src="{{ asset('frontend/eshopper/images/blog/socials.png') }}" alt=""></a>
                        </div>

                        <div class="response-area">
                            <h2> {{ $countBlogcmt }} RESPONSES</h2>
                            <ul class="media-list">
                                @include('frontend.blog.list-comment',['blogcmts'=>$blogId->comment])
                            </ul>
                        </div>

                        <div class="replay-box">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h2>Leave a replay</h2>
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-area">
                                        <form action="" method="POST">
                                            <div class="blank-arrow">
                                                <label>Your Name</label>
                                            </div>
                                            <span>*</span>
                                            <input id="blog_id" type="hidden" name="blog_id" value="{{ $blogId['id'] }}">
                                            <textarea name="message" id="content_cmt" rows="11" class="textarea_message"></textarea>

                                            <button type="submit" class="btn btn-primary blog_cmt">post comment</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
<script src="{{ asset('rate/js/jquery-1.9.1.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = '{{ route("ajax.comment", $blogId->id) }}';
    var check = '{{ auth()->check() }}';
    var  _token = '{{ csrf_token() }}';
    $(document).ready(function () {
        $('.reply_comment').click(function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let form_reply = '.reply-' + id;
            let content_reply = '#message-' + id;
            let contentReply = $(content_reply).val();

            $('.formReply').slideUp();
            // $(form_reply).slideDown();
            //  $(form_reply).css("display", "block");

        });
    });

    $(document).ready(function(){
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');

            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');

            }
        );

        $('.ratings_stars').click(function(){
            let check = '{{ auth()->check() }}';

            if(check){
                var Values =  $(this).find("input").val();
                var url = $(this).closest('.padding-right').find('#form_url').data('url');
                if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).prevAll().andSelf().addClass('ratings_over');
                } else {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                }

                $.ajax({
                    url:url,
                    type:'get',
                    dataType:'json',
                    data:{
                        value: Values
                    },
                    success:function(data){
                        console.log(data);
                    }
                });
            }else{
                Swal.fire('Vui lòng đăng nhập trước khi đánh giá');
            }

        });


        $('.blog_cmt').click(function(){
                let content = $('#content_cmt').val();
                if(check){
                    $.ajax({
                    url:url,
                    type:'POST',
                    dataType:'json',
                    data:{
                        _token:_token,
                        message: content
                    },
                    success:function(data){
                        if(data.success == true)
                        {
                            $('#content_cmt').val(' ');
                            $('.media-list').html(data.html);
                        }
                    }
                });

                }else{
                    Swal.fire('Vui lòng đăng nhập trước khi bình luận');
                }
                return false;
        });
    });


    $(document).ready(function () {
        $('.reply_comment_form').click(function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let content_reply = '#message-' + id;
            let contentReply = $(content_reply).val();
            if(check){
                    $.ajax({
                    url:url,
                    type:'POST',
                    dataType:'json',
                    data:{
                        _token:_token,
                        message: contentReply,
                        reply_id:id
                    },
                    success:function(data){
                        if(data.success == true)
                        {
                            $(content_reply).val('');
                            $('.media-list').html(data.html);
                        }
                    }
                });
                }else{
                    Swal.fire('Vui lòng đăng nhập trước khi bình luận');
                }
        });
        $('.reply_comment').click(function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let form_reply = '.reply-' + id;
            let content_reply = '#message-' + id;
            let contentReply = $(content_reply).val();

            $('.formReply').slideUp();
            $(form_reply).slideDown();

        });
    });

</script>
@endsection
