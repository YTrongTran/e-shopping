
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
                <a href="{{ route('user.index') }}"  class="btn btn-outline-success">
                    Danh sách user
                 </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <form class="form-horizontal mt-4" method="POST" action="{{ route('user.updateUser',['id'=>$user->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Admin" class="form-control form-control-line @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
                                        </div>
                                        <p style="color: red">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="admin@admin.com" class="form-control form-control-line"  id="example-email" name="email" value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control form-control-line" name="password" value="" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="123 456 7890" class="form-control form-control-line" name="phone" value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group" style="margin-bottom: 28px;">
                                        <label class="col-md-12">Address</label>
                                        <div class="col-md-12">
                                            <textarea rows="6" class="form-control form-control-line" name="address">{{ $user->address }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12">
                                            <select class="js-example-placeholder-single js-states form-control @error('country_id') is-invalid @enderror" name="country_id">
                                                <option></option>

                                                @foreach($countrys as $country)
                                                    <option
                                                    {{ ($user->country_id == $country->id) ? 'selected' : '' }}
                                                    value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p style="color: red">
                                            @error('country_id')
                                            {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> File upload</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" id="inputGroupFile01" name="avatar" >
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                        <p style="color: red">
                                            @error('avatar')
                                            {{ $message }}
                                            @enderror
                                        </p>
                                        <img src="{{ asset($user->avatar_path) }}" width="100" height="100" style="object-fit: cover" alt="" srcset="">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-12">Select Role</label>
                                        <div class="col-sm-12">
                                            <select class="js-example-tokenizer js-states form-control @error('roles') is-invalid @enderror" name="roles[]" multiple>
                                                <option></option>
                                                @foreach($roles as $role)
                                                    <option {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }} value="{{ $role['id'] }}">{{ $role['display_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p style="color: red">
                                            @error('roles')
                                            {{ $message }}
                                            @enderror
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Cập nhật user</button>
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
<script src="{{ asset('admins/user/add.js') }}"></script>
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





