
@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">{{ !empty($key)? $key:"" }}</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">{{ !empty($title)? $title:"" }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ !empty($key)? $key:"" }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="create_country">
        <a href="{{ route('blog.create') }}"  class="btn btn-outline-success">
            Add Blog
         </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <div class="table-responsive mt-3">
    <table class="table table-bordered table-responsive-lg">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên bài viết</th>
                <th scope="col">Ảnh đại diện</th>
                <th scope="col">Tên tác giả</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listBlog as $key)
            <tr>

                <th scope="row">{{$loop->index + 1  }}</th>
                <td>{{ $key['name'] }}</td>
                <td><img src="{{ asset( $key['image_blog']) }}" alt="ảnh đại diện"></td>
                <td>{{ $key['user_id'] }}</td>
                <td>
                    <a href="{{ route('country.edit',['id'=> $key['id']]) }}" class="btn btn-outline-info"><i class="me-2 mdi mdi-account-edit" ></i>Edit</a> |
                    <form style="display: inline-block" action="{{ route('country.delete',['id'=>$key['id']]) }}" method="post" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $key['id'] }}" >
                        <button class="btn btn-outline-danger" type="submit" >
                            <i class="me-2 mdi mdi-delete "></i>
                            Deleted
                        </button>

                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $listBlog->links() }}
</div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@endsection





