@extends('admin.layouts.master')

@section('title')
    <title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/user/edit.css') }}">
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
        <div class="row">
            <div class="col-lg-4 col-xlg-3">
                <div class="card">
                    <div class="card-body">
                        <center class="mt-4"> <img src="{{ asset(Auth::user()->avatar_path) }}" class="rounded-circle" width="150">
                            <h4 class="card-title mt-2">{{ Auth::user()->name }}</h4>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6>{{ Auth::user()->email }}</h6> <small class="text-muted pt-4 db">Phone</small>
                        <h6>+{{Auth::user()->phone  }}</h6> <small class="text-muted pt-4 db">Address</small>
                        <h6>{{ Auth::user()->address }}</h6>
                        <div class="map-box">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1708.4335698181783!2d108.2658265204757!3d15.99771685554295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142174c8f171ac3%3A0x5d1534b08f3a1fa0!2zTmfFqSBIw6BuaCBTxqFuLCDEkMOgIE7hurVuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1652894016800!5m2!1svi!2s" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div> <small class="text-muted pt-4 db">Social Profile</small>
                        <br>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xlg-9">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2" action="{{ route('user.update',['id'=> Auth::id()])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Tran trong y" class="form-control form-control-line" name="name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="trantrongy@admin.com" class="form-control form-control-line" name="example-email" id="example-email" name="email" value="{{ Auth::user()->email }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" value="" class="form-control form-control-line" name="password" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line" name="phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line" name="address">{{ Auth::user()->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select class="form-select shadow-none form-control-line" name="country_id">
                                        <option value="">---Select Country---</option>
                                        @foreach($country as $key)
                                        @if ($key['id'] === $checkidCountry->id)
                                            <option  selected value="{{ $key['id'] }}">{{ $key['name'] }}</option>
                                        @else
                                            <option   value="{{ $key['id'] }}">{{ $key['name'] }}</option>

                                        @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> File upload</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="avatar" >
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success text-white">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

    </div>

@endsection

@section('js')
<script src="{{ asset('admins/user/edit.js') }}"></script>
{!! Toastr::message() !!}
@endsection
