
@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">
<link rel="stylesheet" href="{{ asset('admins/setting/list.css') }}">
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
            <div class="row">
                <ul class="navbar-nav float-end">
                    <li class="nav-item dropdown">

                        <a class=" btn btn-outline-success" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Thêm setting
                        </a>
                        @can('setting-add')
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('setting.create',['type'=>'Text']) }}"><i ></i>
                                    Text</a>
                                    <a class="dropdown-item" href="{{ route('setting.create',['type'=>'Textarea']) }}"><i ></i>
                                        Textarea</a>
                            </ul>
                        @endcan
                    </li>
                </ul>
            </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <div class="table-responsive mt-3">
    <table class="table table-bordered table-responsive-lg">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Key setting</th>
                <th scope="col">Value setting</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($settings as $setting)
            <tr>

                <th scope="row">{{$loop->index + 1  }}</th>
                <td>{{ $setting['config_key'] }}</td>
                <td class='setting_list'>{{ $setting['config_value'] }}</td>
                <td>
                    @can('setting-edit')
                    <a href="{{ route('setting.edit',['id'=> $setting['id'],'type'=>$setting->type]) }}" class="btn btn-outline-info"><i class="me-2 mdi mdi-account-edit" ></i>Sửa</a>
                    @endcan

                    @can('setting-delete')
                        <form style="display: inline-block" action="{{ route('setting.delete',['id'=>$setting['id']]) }}" method="post" >
                            @csrf
                            <input type="hidden" name="id" value="{{ $setting['id'] }}" >
                            <button class="btn btn-outline-danger" type="submit" >
                                <i class="me-2 mdi mdi-delete "></i>
                                Xoá
                            </button>
                        </form>
                    @endcan

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $settings->links() }}
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





