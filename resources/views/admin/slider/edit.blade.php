
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
                <a href="{{ route('slider.index') }}"  class="btn btn-outline-success">
                   Danh sách slider
                 </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <form class="form-horizontal mt-4" method="POST" action="{{ route('slider.update',['id'=>$slider->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên slider(<span class="help" style="color:red">*</span>)</label>
                                <input type="text" class="form-control" placeholder="..." name="name" value="{{$slider->name }}">
                            </div>
                            <div class="form-group">
                                <label>Mô tả slider(<span class="help" style="color:red">*</span>)</label>
                                <textarea name="desc" cols="156"   rows="5" style="display: block;resize: none;"  >{{implode (" ",explode("-",$slider['description']))}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Ảnh đại diện bài viết(<span class="help" style="color:red">*</span>)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="slider_image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <img src="{{ asset( $slider['name_image_path']) }}" alt="ảnh slider" style="width: 100px;height: 100px;object-fit: cover; margin:10px">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái(<span class="help" style="color:red">*</span>)</label>
                               <select name="status" >
                                    <option {{ ($slider['status'] == 0) ? "selected" :" " }} selected value="0">Hiển thị</option>
                                    <option  {{ ($slider['status'] == 1) ? "selected" :" " }} value="1">Không hiển thị</option>
                               </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Cập nhật slider</button>
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





