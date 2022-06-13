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
        <a href="{{ route('product.index') }}" class="btn btn-outline-success">
            Danh sách sản phẩm
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <form class="form-horizontal mt-4" method="POST" action="{{ route('product.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tên sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                <input type="text" class="form-control" placeholder="Nhập giá sản phẩm" name="price"
                                    value="{{ old('price') }}">
                            </div>
                            <div class="form-group">
                                <label>Số lượng sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                <input type="text" class="form-control" placeholder="Nhập số lượng sản phẩm"
                                    name="quantity" value="{{ old('quantity') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Danh mục sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                <select class="js-example-placeholder-single js-states form-control" name="category_id">
                                    <option></option>
                                    {!! $categorys !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập tags sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                <select class="form-control js-example-tokenizer" multiple="multiple"
                                    name="tags_array[]">
                                    <option></option>
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
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            name="feature_image" value="{{ old('feature_image') }}">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Chọn nhiều ảnh sản phẩm(<span class="help" style="color:red">*</span>)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01"
                                            name="image_array[]" multiple value="{{ old('image_array') }}">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label style="color: green">Trạng thái (<span class="help"
                                        style="color:red">*</span>)</label>
                                <select name="status" id="">
                                    <option value="0">Hiển thị</option>
                                    <option value="1">Không hiển thị</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label style="color: green">Thương hiệu (<span class="help"
                                        style="color:red">*</span>)</label>
                                <select name="brand_id" id="">
                                    @forelse ($brands as $key => $value)
                                    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    @empty
                                    <option value="">Không có dữ liệu</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" style="display: flex;">
                                <label style="color: green">Chọn sale (<span class="help"
                                        style="color:red">*</span>)</label>
                                <select name="sale" id="" style="width: 100px;height: 30px;">
                                    <option value="0" class="selected_sale">New</option>
                                    <option value="1" class="selected_sale">Sale</option>
                                </select>
                                <div class="number_sale active">
                                    <input type="text" name="number_sale" style="margin-left: 10px;"> %
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mô tả sản phẩm(<span class="help" style="color:red">*</span>)</label>
                        <textarea name="content" id="content" cols="100" rows="20"
                            style="display: block;resize: none;">{{ old('content') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Thêm sản phẩm</button>
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
