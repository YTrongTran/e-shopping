
@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/user/edit.css') }}">
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">
<link rel="stylesheet" href="{{ asset('admins/products/add.css') }}">
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
                <a href="{{ route('product.index') }}"  class="btn btn-outline-success">
                    Danh sách sản phẩm
                 </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <form class="form-horizontal mt-4" method="POST" action="{{ route('product.update',['id'=>$product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Tên sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="name" value="{{ $product->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                        <input type="text" class="form-control" placeholder="Nhập giá sản phẩm" name="price" value="{{ $product->price }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Danh mục sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                        <select class="js-example-placeholder-single js-states form-control" name="category_id">
                                            <option ></option>
                                            {!! $categorys !!}
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Nhập tags sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                        <select class="form-control js-example-tokenizer" multiple="multiple" name="tags_array[]" >
                                            @foreach ($product->tags as $key => $value)
                                            <option selected value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Chọn Ảnh đại diện sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="feature_image" value="{{ old('feature_image') }}">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ asset($product->feature_image_path) }}" width="100" height="100" alt="" style="object-fit: cover; object-position: center">
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Chọn nhiều ảnh sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="image_array[]" multiple value="{{ old('image_array') }}">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($product->product as $value)
                                    <img src="{{ asset($value['image_path']) }}" width="100" height="100" alt="" style="object-fit: cover; object-position: center">
                                    @endforeach
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Mô tả sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                <textarea name="content" id="content" cols="100" rows="20" style="display: block;resize: none;"  >{{ $product->content }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-outline-primary">Cập nhật sản phẩm</button>
                            <button type="reset" class="btn btn-outline-danger">Huỷ</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

@endsection

@section('js')
{!! Toastr::message() !!}
<script src="{{ asset('admins/products/select2.js') }}"></script>
<script src="{{ asset('admins/user/edit.js') }}"></script>
<script src="{{ asset('admins/products/add.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( "content", {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } );
    </script>
@endsection





