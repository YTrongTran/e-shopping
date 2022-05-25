
@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">
<link rel="stylesheet" href="{{ asset('admins/role/add.css') }}">

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
                            <div class="checkall" style="margin-bottom: 10px">
                                <input type="checkbox" class="form-check-input checkall" id="checkall">
                                <label class="form-check-label mb-0" for="checkall">Check all</label>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    @foreach ($permissionsParent as $permission)
                                        <div class="card bg-light mb-3 " style="padding: 0">
                                            <div class="icon">
                                                <i class="me-2 mdi mdi-apple-keyboard-control card_icon"></i>
                                            </div>
                                            <div class="card-header">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input check_all"
                                                        id="{{ $permission['id'] }}">
                                                    <label class="form-check-label mb-0" for="{{ $permission['id'] }}">Quản lý
                                                        {{ $permission['name'] }}</label>
                                                </div>
                                            </div>
                                            <div class="card-body active" style="display: flex;justify-content: space-between;">
                                                @foreach ($permission->childs as $key => $value)
                                                    <div class="card-title">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="{{ $value['id'] }}" {{ $permissionCheck->contains('id', $value['id']) ? 'checked' : '' }} value="{{ $value['id'] }}"
                                                                name="childs[]">
                                                            <label class="form-check-label mb-0"
                                                                for="{{ $value['id'] }}">{{ $value['name'] }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.check_all').click(function() {
            $(this).closest('.card').find('.form-check-input').prop("checked", $(this).prop("checked"));
        });
        $('.checkall').click(function() {
            $(this).parents().find('.form-check-input').prop("checked", $(this).prop("checked"));
        });
        $('.card_icon').click(function(){
             let check = $(this).closest('.card').find('.card-body').hasClass('active');

            if(check == true){
                $(this).closest('.card').find('.card-body').removeClass('active').hide();
            }else{
                $(this).closest('.card').find('.card-body').addClass('active').show();
            }
        });
    });
</script>
@endsection





