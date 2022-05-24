
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
        <a href="{{ route('permission.create') }}"  class="btn btn-outline-success">
           Thêm quyền cho vai trò
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
                <th scope="col">Tên vai trò</th>
                <th scope="col">Mô tả vai trò</th>
                <th scope="col">Mô phỏng key code</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>

                <th scope="row">{{$loop->index + 1  }}</th>
                <td>{{ $permission['name'] }}</td>
                <td>{{ $permission['display_name'] }}</td>
                <td>{{ $permission['key_code'] }}</td>
                <td>
                    <a href="{{ route('permission.edit',['id'=> $permission['id']]) }}" class="btn btn-outline-info"><i class="me-2 mdi mdi-account-edit" ></i>Sửa</a> |
                    <form style="display: inline-block" action="{{ route('permission.delete',['id'=>$permission['id']]) }}" method="post" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $permission['id'] }}" >
                        <button class="btn btn-outline-danger" type="submit" >
                            <i class="me-2 mdi mdi-delete "></i>
                            Xoá
                        </button>

                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $permissions->links() }}
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





