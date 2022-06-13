@extends('admin.layouts.master')

@section('title')
<title>Admin E-Shopping</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/country/list.css') }}">
<link rel="stylesheet" href="{{ asset('admins/manager-order/list.css') }}">
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

<div class="back">
    <a href="{{ route('manager-order.index') }}"
        style="display: inline-block;color: green;font-size: 30px;margin-left: 15px;position: absolute;top: 71px;left: 14px;z-index: 100;">
        <i class="me-2 mdi mdi-backburger"></i></a>
</div>

<div class="container-fluid">
    <div id="print_code">
        <a href="{{ route('manager-order.print_code',['order_code'=> $orderId->order_code]) }}">Print Order</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <div class="table-responsive mt-3">
                    <p style="text-align: center; font-size: 20px;font-weight: bold;color:green">Thông tin khách hàng
                    </p>
                    <table class="table table-bordered table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1
                            @endphp
                            <tr>
                                <th scope="row">{{$i }}</th>
                                <td>{{$orderId->user->name }}</td>
                                <td>{{$orderId->user->email }}</td>
                                <td>{{$orderId->user->phone }}</td>
                            </tr>

                            @php
                            $i++
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <div class="table-responsive mt-3">
                    <p style="text-align: center; font-size: 20px;font-weight: bold;color:green">Thông tin vận chuyển
                    </p>
                    <table class="table table-bordered table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người vận chuyển</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Hình thức thanh toán</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                $i = 1
                                @endphp
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $orderId->shipping->name }}</td>
                                <td>{{ $orderId->shipping->address }}</td>
                                <td>{{ $orderId->shipping->phone }}</td>
                                <td>
                                    @if ($orderId->shipping->method == 1)
                                    {{ 'Trả bằng thẻ ATM' }}
                                    @elseif($orderId->shipping->method == 2)
                                    {{ "Nhận tiền mặt" }}
                                    @elseif($orderId->shipping->method == 3)
                                    {{ 'Thanh toán thẻ ghi nợ' }}
                                    @endif
                                </td>
                            </tr>
                            @php
                            $i++
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <div class="table-responsive mt-3">
                    <p style="text-align: center; font-size: 20px;font-weight: bold; color:green">Liệt kê chi tiết đơn
                        hàng</p>
                    <table class="table table-bordered table-responsive-lg">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Số lượng trong kho còn</th>
                                <th scope="col">Số lượng người mua</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Ngày đặt</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_details as $order_detail)
                            <tr>
                                <th scope="row">{{$loop->index + 1 }}</th>

                                <td>{{ $order_detail->product_name }}</td>
                                <td>{{ $order_detail->order_code }}</td>

                                @foreach ($row as $quantity_product)
                                @if ($order_detail->product_id == $quantity_product['id'])
                                <td> {{ $quantity_product['quantity'] }}</td>
                                @endif

                                @endforeach

                                <td class="quantity_order_details">{{
                                    $order_detail->product_sales_quantity }}
                                    <input type="hidden" name="product_sales_quantity"
                                        value="{{$order_detail->product_sales_quantity  }}">
                                    <input type="hidden" name="orderdetailsId" value="{{$order_detail->product_id  }}">
                                </td>
                                <td>{{ number_format($order_detail->product_price,0,'','.') }} đ</td>
                                <td>{{ number_format(($order_detail->product_price *
                                    $order_detail->product_sales_quantity), 0,
                                    '', '.')
                                    }} đ</td>

                                <td>{{ date('d/m/Y H:i:s', strtotime($order_detail->created_at)) }}</td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                    @php
                    $sum = 0;
                    foreach ($order_details as $order_detail)
                    {
                    $product_ext = $order_detail->product_ext;
                    $sum += $order_detail->product_price * $order_detail->product_sales_quantity;
                    }
                    @endphp
                    <div id="sum" style="text-align: left;margin-left: 64%;">

                        <p>Thuế: <span style="background-color: #3189f3; color: #fff">{{ number_format($product_ext ,
                                0,'',
                                '.')}} đ</span></p>
                        <p>Tổng tiền chưa có thuế: <span style="background-color: #3189f3; color: #fff">{{
                                number_format($sum , 0,'', '.') }} đ</span></p>
                        <p>Tổng tiền đã có thuế: <span style="background-color: #3189f3; color: #fff">{{
                                number_format($sum + $product_ext, 0,'', '.') }} đ</span></p>

                    </div>

                    <div id="sum" style="text-align: left;margin-top: -110px;">
                        <div class="col-sm-5">
                            <select class="form-select order_select">
                                <option value="">-----Chọn hình thức đơn hàng-----</option>
                                <option {{ ($orderId->order_status ==1) ? 'selected' : ' '}} value="1"
                                    id="{{$orderId->id }}">Đang xử lý
                                </option>
                                <option {{ ($orderId->order_status ==2) ? 'selected' : ' '}} value="2"
                                    id="{{$orderId->id }}">Đã xử lý giao
                                    hàng</option>
                                <option {{ ($orderId->order_status ==3) ? 'selected' : ' '}} value="3"
                                    id="{{$orderId->id }}">Huỷ đơn hàng tạm
                                    thời</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{!! Toastr::message() !!}
<script>
    $(document).ready(function () {
        $(".order_select").change(function (e) {
            e.preventDefault();
            let order_status = $(this).val();
            let order_id = $(this).children(':selected').attr('id');

            let array_quantity  = [];
            $.each($('input[name="product_sales_quantity"]'), function () {
                array_quantity.push($(this).val());
            });

            let array_id  = [];
            $.each($('input[name="orderdetailsId"]'), function () {
                array_id.push($(this).val());
            });

            $.ajax({
                type: "GET",
                url:  '{{ route("manager-order.update_quantity") }}',
                data: {
                    order_id:order_id,
                    order_status:order_status,
                    array_quantity:array_quantity,
                    array_id:array_id,
                },
                dataType: "json",
                success: function (response) {
                    if(response.code == 200)
                    {
                        if(response.data){
                            alert(response.data);
                        }
                        alert(response.messages);
                        location.reload();
                    }
                }
            });

        });
    });
</script>
@endsection
