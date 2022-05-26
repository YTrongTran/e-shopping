
@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/user/edit.css') }}">
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
                <a href="{{ route('setting.index') }}"  class="btn btn-outline-success">
                   Danh sách setting
                 </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <form class="form-horizontal mt-4" method="POST" action="{{ route('setting.update',['id'=>$setting->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên key(<span class="help" style="color:red">*</span>)</label>
                                <input type="text" class="form-control" placeholder="..." name="config_key" value="{{ $setting->config_key }}">
                            </div>
                            @php
                                $url =  request()->get('type')
                            @endphp
                            @if ( $url == 'Text' )
                                <input type="hidden" name="type" value="Text">
                                <div class="form-group">
                                    <label>Giá trị key(<span class="help" style="color:red">*</span>)</label>
                                    <input type="text" class="form-control" placeholder="..." name="config_value" value="{{ $setting->config_value }}">
                                </div>
                            @elseif ($url == 'Textarea' )
                                <input type="hidden" name="type" value="Textarea">
                                <div class="form-group">
                                    <label>Giá trị key(<span class="help" style="color:red">*</span>)</label>
                                    <textarea name="config_value" cols="156"   rows="5" style="display: block;resize: none;"  >{{ $setting->config_value }}</textarea>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-outline-primary">Cập nhật setting</button>
                            <button type="reset" class="btn btn-outline-danger">Huỷ </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

@endsection

@section('js')
<script src="{{ asset('admins/user/edit.js') }}"></script>
{!! Toastr::message() !!}
@endsection





