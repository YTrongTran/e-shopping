@extends('frontend.layouts.master')
@section('title')
    <title>Blog | E-Shopper</title>
@endsection

@section('css')
   <link rel="stylesheet" href="{{ asset('frontend/blog/list.css') }}">
@endsection

@section('content')

    <section>
        <div class="container">
            <div class="row">
                @include('frontend.container.left-sidebar')

                <div class="col-sm-9 padding-right">
                        <div class="blog-post-area">
                            <h2 class="title text-center">Latest From our Blog</h2>
                            @forelse ($blogs as $blog)
                            <div class="single-blog-post">
                                <h3>{{ $blog->name }}</h3>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> {{ $blog->user->name }}</li>
                                        <li><i class="fa fa-clock-o"></i> {{ date('H:i', strtotime($blog->created_at)) }} pm</li>
                                        <li><i class="fa fa-calendar"></i>{{ date('M d'.','.'Y', strtotime($blog->created_at)) }}</li>
                                    </ul>
                                    <span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                    </span>
                                </div>
                                <a href="">
                                    <img src="{{ asset($blog->image_path) }}" width="862" height="398" style="object-fit: cover" alt="">
                                </a>
                                <div class="description">
                                    <p>{!! $blog->description !!}</p>
                                </div>
                                <a class="btn btn-primary" href="{{ route('frontend.blog.show',[ 'slug'=> $blog->display_name,'id'=>$blog->id]) }}">Read More</a>
                            </div>
                            @empty
                            <div class="single-blog-post">
                                <h3 style="text-align: center">Chưa có bài viết nào</h3>
                            </div>
                            @endforelse


                            <div class="pagination-area">
                                {{ $blogs->links() }}
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')

@endsection
