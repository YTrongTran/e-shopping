
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
                        <form class="form-horizontal mt-4" method="POST" action="{{ route('role.update',['id'=>$role->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tên vai trò(<span class="help" style="color:red">*</span>)</label>
                                        <input type="text" class="form-control" placeholder="Role name..." name="name" value="{{ $role->name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mô tả vai trò(<span class="help" style="color:red">*</span>)</label>
                                        <input type="text" class="form-control" placeholder="Role discription..." name="display_name" value="{{ $role->display_name }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Cập nhật vai trò</button>
                            <button type="reset" class="btn btn-outline-danger">Huỷ</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

@endsection

@section('js')

@endsection





