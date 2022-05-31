@extends('frontend.layouts.master')
@section('title')
<title>Profile | E-Shopper</title>
@endsection

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="panel-group category-products" id="accordian">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        Account
                                    </a>
                                </h4>
                            </div>
                            <div id="sportswear" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="{{ route('frontend.member.edit',['id'=> (!empty(auth()->user()->id) ?  auth()->user()->id : '')]) }}">Profile </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material mx-2" action="{{ route('frontend.member.update',['id'=>$users->id]) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="whoEusAN6o2Q0NdoAoDfKNATf04g0j5c0Jgzr6O0">
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Tran trong y" class="form-control form-control-line " name="name" value="{{ $users->name }}">
                                </div>
                                <p style="color: red">
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="trantrongy@admin.com" class="form-control form-control-line" name="example-email" id="example-email" value="{{ $users->email }}" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" value="" class="form-control form-control-line" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line" name="phone" value="{{ $users->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line" name="address">{{ $users->address }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select class="form-select shadow-none form-control-line " name="country_id">
                                        <option value="">---Select Country---</option>
                                        @forelse ($countrys as $country)

                                        <option
                                        {{ ($users->country_id == $country->id ) ? 'selected':'' }}
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                        @empty
                                        <option value="">--No--</option>
                                        @endforelse
                                    </select>
                                </div>
                                <p style="color: red">
                                </p>
                            </div>
                            <div class="form-group" style="margin-left: 5px">
                                <label> File upload</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input " id="inputGroupFile01" name="avatar">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <img src="{{ asset($users->avatar_path) }}" width="100" height="100" style="object-fit: cover; margin: 10px" alt="">
                                <p style="color: red">
                                </p>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success text-white">Cập nhật hồ sơ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')

@endsection
