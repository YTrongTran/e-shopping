
@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">
<link rel="stylesheet" href="{{ asset('admins/slider/list.css') }}">
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
        @can('slider-add')
        <a href="{{ route('slider.create') }}"  class="btn btn-outline-success">
            Thêm slider
         </a>
        @endcan

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <div class="table-responsive mt-3">
    <table class="table table-bordered table-responsive-lg">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên slider</th>
                <th scope="col">Mô tả slider</th>
                <th scope="col">Ảnh slider</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
            <tr>

                <th scope="row">{{$loop->index + 1  }}</th>
                <td>{{ $slider['name'] }}</td>
                <td class="desciption">{{ implode (" ",explode("-",$slider['description'])) }}</td>
                <td><img src="{{ asset( $slider['name_image_path']) }}" alt="ảnh slider" style="width: 100px;height: 100px;object-fit: cover;"></td>
                <td >
                    @if ($slider['status'] == 0)
                        <p class="on_slider">Hiển thị</p>
                    @else
                        <p class="off_slider">Không hiển thị</p>
                    @endif

                </td>
                <td>
                    @can('slider-edit')
                    <a href="{{ route('slider.edit',['id'=> $slider['id']]) }}" class="btn btn-outline-info"><i class="me-2 mdi mdi-account-edit" ></i>Sửa</a>
                    @endcan

                    @can('slider-delete')
                    <form style="display: inline-block" action="{{ route('slider.delete',['id'=>$slider['id']]) }}" method="post" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $slider['id'] }}" >
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
    {{ $sliders->links() }}
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





