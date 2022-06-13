@extends('frontend.layouts.master')
@section('title')
<title>Home | E-Shopper</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div>
        <div class="register-req">
            <p>Vui lòng đăng nhập hoặc đăng ký tài khoản(nếu chưa có) để thanh toán giỏ hàng và xem lại lịch sử </p>
        </div>
        @if (auth()->check())
        <form action="{{ route('check.register') }}" method="post">
            @csrf
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="shopper-info">
                            <p>Thông tin gửi hàng</p>
                            <input class="form-control" type="text" placeholder="Họ và tên" name="name"
                                value='{{ old("name") }}' style="margin-bottom: 10px;">
                            <input class=" form-control" type="email" required placeholder="Địa chỉ email" name="email"
                                value='{{ old("email") }}' style="margin-bottom: 10px;">
                            <input class="form-control" type="text" placeholder="Địa chỉ" name="address"
                                value="{{ old('address') }}" style=" margin-bottom: 10px">
                            <input class="form-control" type="text" placeholder="Số điện thoại" name="phone"
                                value="{{ old('phone') }}">

                            <div class="order-message">
                                <p>Ghi chú</p>
                                <textarea name="message"
                                    placeholder="Ghi chú về đơn đặt hàng của bạn, Ghi chú đặc biệt khi giao hàng"
                                    rows="16" style="font-size: 20px;"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($carts))
                        @foreach ($carts as $key => $value)
                        <tr style="cursor: pointer">
                            <td class="cart_product">
                                <a><img src="{{ $carts[$key]['image'] }}" alt="" width="110" height="110"
                                        style="object-fit: cover;"></a>
                            </td>
                            <td class="cart_description" style="width: 350px">
                                <h4><a>{{ $carts[$key]['name'] }}</a></h4>

                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($carts[$key]['price'], 0, ' ', '.') }} đ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a data-id="{{ $carts[$key]['id'] }}" class="cart_quantity_up"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                        value="{{ $carts[$key]['quantity'] }}" autocomplete="off" size="2" min="1">
                                    <a data-id="{{ $carts[$key]['id'] }}" class="cart_quantity_down"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{ number_format($carts[$key]['price'] * $carts[$key]['quantity'], 0, ' ', '.') }}
                                    đ</p>
                            </td>
                            <td class="cart_delete">
                                <a data-id="{{ $carts[$key]['id'] }}" class="cart_quantity_delete"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            @php
                            $sum = 0;
                            @endphp
                            @if (!empty(session()->get('card')))
                            @foreach (session()->get('card') as $key => $value)
                            @php
                            $sum += $value['price']*$value['quantity']
                            @endphp
                            @endforeach

                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result total_checkout">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td id="sub_total">{{ number_format($sum,0,'','.') }} đ</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>22.000 đ</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span id="total">{{ number_format(($sum+(int)22000),0,'','.') }} đ</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            @else

                        <tr>
                            <td>Cart Sub Total</td>
                            <td id="sub_total">0 đ</td>
                        </tr>
                        <tr>
                            <td>Exo Tax</td>
                            <td>22.000 đ</td>
                        </tr>
                        <tr class="shipping-cost">
                            <td>Shipping Cost</td>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><span id="total">22.000 đ</span></td>
                        </tr>

                        @endif
                        </tr>
                        @else
                        <tr>
                            <td colspan="6">
                                <p style="text-align: center; font-size: 20px;" id="no_session">
                                    {{ 'Chưa có sản phẩm nào trong giỏ hàng !!!
                                    ' }}
                                </p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="payment-options">
                <span style="margin-bottom: 10px; display: block;"><label>Chọn hình thức thanh toán</label></span>
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Nhận tiền mặt</label>
                </span>
                <span>
                    <label><input name="payment_option" value="3" type="checkbox"> Thanh toán thẻ ghi nợ</label>
                </span>
                <span>

                    <label><button type="submit" class="btn btn-default update" style="margin-top: 0">Đặt
                            hàng</button></label>
                </span>
            </div>
        </form>
        @else
        <p>Vui lòng đăng nhập mới có thông tin để nhập.</p>
        @endif
    </div>
</section>

@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $(document).ready(function () {

            $(".cart_quantity_up").click(function(e) {
                e.preventDefault();
                let _url = '{{ URL::route('cart.addquantity') }}';
                let id = $(this).data("id");
                let quantity = $(this).closest('.cart_quantity_button').find('.cart_quantity_input').val();
                let price = $(this).closest("tr").find(".cart_price p").text();
                let total_price = $(this).closest("tr").find(".cart_total .cart_total_price").text();
                //
                let stringPrice = '';
                for (let i = 0; i < price.split('.').length; i++) {
                    stringPrice += price.split('.')[i];
                }
                let prices = stringPrice.split('đ')[0];
                let that = $(this);
                //cart total sub
                let sub_total = $(this).closest('body').find('.total_checkout #sub_total').text();
                let stringsubtotal = '';
                for (let i = 0; i < sub_total.split('.').length; i++) {
                    stringsubtotal += sub_total.split('.')[i];
                }
                let price_sub_total = stringsubtotal.split('đ')[0];
                //
                let total = $(this).closest('body').find('.total_checkout #total').text();

                $.ajax({
                    type: "get",
                    url: _url,
                    data: {
                        id: id,

                    },
                    dataType: "html",
                    success: function(data) {

                        JSON.parse(data).forEach(value => {
                            if (id == value.id) {
                                that.closest('.cart_quantity_button').find('.cart_quantity_input')
                                    .val(parseInt(value.quantity));
                                let cart_total = (parseInt(value.quantity) * parseInt(value.price))
                                    .toString();
                                let number_total = (cart_total).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                                    "$1.").toString();
                                that.closest("tr").find(".cart_total .cart_total_price").text(
                                    number_total + " đ");

                                let stringnumbersubtotal = (parseInt(value.price)+parseInt(price_sub_total)).toString();

                                let stringtotal = ((parseInt(value.price)+parseInt(price_sub_total)) + parseInt(22000)).toString();

                                let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                                "$1.").toString();

                                let total_tax = (stringtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                                "$1.").toString();

                                that.closest('body').find('.total_checkout #sub_total').text(number_subtotal + ' đ');
                                that.closest('body').find('.total_checkout #total').text(total_tax + ' đ');
                            }
                        });

                    },
                });
            });

            $(".cart_quantity_down").click(function(e) {
                e.preventDefault();

                let _url = '{{ URL::route('cart.upquantity') }}';
                let id = $(this).data("id");
                let name  =$(this).closest('tr').find('.cart_description h4 a').text();
                let quantity = $(this).closest('.cart_quantity_button').find('.cart_quantity_input').val();

                let price = $(this).closest("tr").find(".cart_price p").text();
                let total_price = $(this).closest("tr").find(".cart_total .cart_total_price").text();

                let stringPrice = '';
                for (let i = 0; i < price.split('.').length; i++) {
                    stringPrice += price.split('.')[i];
                }
                let prices = stringPrice.split('đ')[0];


                let that = $(this);
                let check = 0;
                //cart total sub tax
                let sub_total = $(this).closest('body').find('.total_checkout #sub_total').text();
                let stringsubtotal = '';
                for (let i = 0; i < sub_total.split('.').length; i++) {
                    stringsubtotal += sub_total.split('.')[i];
                }
                let price_sub_total = stringsubtotal.split('đ')[0];
                //
                let total = $(this).closest('body').find('.total_checkout #total').text();


                    if(parseInt(quantity-1) < 1)
                {
                    if(confirm('Bạn có muốn xoá sản phẩm '+name+' này không')){

                        check;
                        let stringnumbersubtotal = (parseInt(price_sub_total) - parseInt(prices)).toString();
                        let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                        "$1.").toString();
                        that.closest('body').find('.total_checkout #sub_total').text(number_subtotal + ' đ');
                        let stringtotal = ((parseInt(price_sub_total) - parseInt(prices)) + parseInt(22000)).toString();

                        let total_tax = (stringtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                        "$1.").toString();
                        that.closest('body').find('.total_checkout #total').text(total_tax + ' đ');

                        $(this).closest('tr').remove();

                    }else{
                        check = 1;
                        //hiển thị giá ở sub total
                        let stringnumbersubtotal = (parseInt(price_sub_total)).toString();
                        let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                "$1.").toString();
                        that.closest('body').find('.total_checkout #sub_total').text(number_subtotal + ' đ');
                    }
                }else{
                    let stringnumbersubtotal = (parseInt(price_sub_total) - parseInt(prices)).toString();
                    let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                    "$1.").toString();
                    that.closest('body').find('.total_checkout #sub_total').text(number_subtotal + ' đ');

                    let stringtotal = ((parseInt(price_sub_total) - parseInt(prices)) + parseInt(22000)).toString();
                    let total_tax = (stringtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                    "$1.").toString();
                    that.closest('body').find('.total_checkout #total').text(total_tax + ' đ');
                }


                $.ajax({
                    type: "get",
                    url: _url,
                    data: {
                        id: id,
                        check:check,
                    },
                    dataType: "html",
                    success: function(res) {

                        JSON.parse(res).forEach(value => {
                            if (id == value.id) {
                            that.closest('.cart_quantity_button').find('.cart_quantity_input').val(parseInt(value.quantity));
                            let cart_total = (parseInt(value.quantity) * parseInt(value.price)).toString();
                            let number_total = (cart_total).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.").toString();
                            that.closest("tr").find(".cart_total .cart_total_price").text(number_total+ " đ");


                            }
                        });
                    },
                });

            });
            $(".cart_quantity_delete").click(function(e) {
                e.preventDefault();

                let _url = '{{ URL::route("cart.deleted") }}';
                let id = $(this).data("id");
                let quantity = $(this).closest('tr').find('.cart_quantity .cart_quantity_input').val();

                let price = $(this).closest("tr").find(".cart_price p").text();
                let total_price = $(this).closest("tr").find(".cart_total .cart_total_price").text();

                let stringPrice = '';
                for (let i = 0; i < price.split('.').length; i++) {
                    stringPrice += price.split('.')[i];
                }
                let prices = stringPrice.split('đ')[0];

                let that = $(this);
                let check = 0;
                //cart total sub tax
                let sub_total = $(this).closest('body').find('.total_checkout #sub_total').text();
                let stringsubtotal = '';
                for (let i = 0; i < sub_total.split('.').length; i++) {
                    stringsubtotal += sub_total.split('.')[i];
                }
                let price_sub_total = stringsubtotal.split('đ')[0];
                //
                let total = $(this).closest('body').find('.total_checkout #total').text();


                //remove
                let stringnumbersubtotal = (parseInt(price_sub_total) - (parseInt(prices) * parseInt(quantity))).toString();
                let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                "$1.").toString();
                that.closest('body').find('.total_checkout #sub_total').text(number_subtotal + ' đ');

                let stringtotal = ((parseInt(price_sub_total) - (parseInt(prices) * parseInt(quantity))) + parseInt(22000)).toString();
                let total_tax = (stringtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                "$1.").toString();
                that.closest('body').find('.total_checkout #total').text(total_tax + ' đ');

                $(this).closest('tr').remove();
                $.ajax({
                    type: "get",
                    url: _url,
                    data: {
                        id: id,
                    },
                    dataType: "html",
                    success: function(res) {
                        JSON.parse(res).forEach(value => {
                            if (id == value.id) {
                            that.closest('.cart_quantity_button').find('.cart_quantity_input').val(parseInt(value.quantity));
                            let cart_total = (parseInt(value.quantity) * parseInt(value.price)).toString();
                            let number_total = (cart_total).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.").toString();
                            that.closest("tr").find(".cart_total .cart_total_price").text(number_total+ " đ");
                            }
                        });
                    },
                });

            });

        });
</script>
@endsection
