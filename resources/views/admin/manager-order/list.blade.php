@extends('admin.layouts.master')

@section('title')
<title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">
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
                            <a href="{{ route('manager-order.index') }}">{{ !empty($title)? $title:"" }}</a>
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

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người đặt</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Ngày tháng đặt hàng</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($manager_orders as $manager_order)
                            <tr>
                                <th scope="row">{{$loop->index + 1 }}</th>
                                <td>{{ $manager_order->user->name }}</td>
                                <td>{{$manager_order->order_code }} </td>
                                <td>
                                    @if ($manager_order['order_status'] == 1)
                                    {{ 'Đơn hàng mới' }}
                                    @elseif($manager_order['order_status'] == 2)
                                    {{ 'Đơn hàng đã xử lý' }}
                                    @else
                                    {{ 'Đã huỷ đơn hàng' }}
                                    @endif
                                </td>
                                <td>{{ date("d/m/Y H:i:s", strtotime($manager_order->created_at)) }}</td>
                                <td>

                                    <a href="{{ route('manager-order.show',['order_code'=> $manager_order['order_code']]) }}"
                                        class="btn btn-outline-info"><i class="me-2 mdi mdi-eye"></i>Show</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $manager_orders->links() }}
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
