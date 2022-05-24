
@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">

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
                <a href="{{ route('role.index') }}"  class="btn btn-outline-success">
                   Danh sách vai trò
                 </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <form class="form-horizontal mt-4" method="POST" action="{{ route('role.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tên vai trò(<span class="help" style="color:red">*</span>)</label>
                                        <input type="text" class="form-control" placeholder="Role name..." name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mô tả vai trò(<span class="help" style="color:red">*</span>)</label>
                                        <input type="text" class="form-control" placeholder="Role discription..." name="display_name" value="{{ old('display_name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-sm-12">
                                    @foreach ($permissionsParent as $permission )
                                        <div class="card bg-light mb-3" style="padding: 0">
                                            <div class="card-header">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input check_all" id="{{ $permission['id'] }}" name="{{ $permission['name'] }}">
                                                        <label class="form-check-label mb-0" for="{{ $permission['id'] }}">Quản lý {{ $permission['name'] }}</label>
                                                    </div>
                                                </div>
                                                <div class="card-body" style="display: flex;justify-content: space-between;">
                                                    @foreach ($permission->childs as $value)
                                                        <div class="card-title" >
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="{{ $value['id'] }}" name="{{ $value['name'] }}">
                                                                <label class="form-check-label mb-0" for="{{ $value['id'] }}">{{ $value['name'] }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Thêm vai trò</button>
                            <button type="reset" class="btn btn-outline-danger">Huỷ</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script >
    $(document).ready(function(){
        $('.check_all').click(function(){
             $(this).parents().find('.form-check-input').prop("checked",$(this).prop("checked"));
        });

    });
</script>
@endsection





