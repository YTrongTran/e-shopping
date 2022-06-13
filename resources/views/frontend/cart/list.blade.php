@extends('frontend.layouts.master')
@section('title')
<title>Shopping Cart | E-Shopper</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
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


                                @if(session()->get('quantity'.$carts[$key]['id']))
                                <input class="cart_quantity_product" type="hidden"
                                    value=" {{session()->get('quantity'.$carts[$key]['id']) }}">
                                @endif
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
    </div>
</section>

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        @php
                        $sum = 0;
                        @endphp
                        @if (!empty(session()->get('card')))

                        @foreach (session()->get('card') as $key => $value)
                        @php
                        $sum += $value['price']*$value['quantity']
                        @endphp

                        @endforeach

                        <li>Cart Sub Total <span id="sub_total">{{ number_format($sum,0,'','.') }} đ</span></li>
                        <li>Eco Tax <span>22.000 đ</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span id="total">{{ number_format(($sum+(int)22000),0,'','.') }} đ</span></li>
                        @else
                        <li>Cart Sub Total <span>0 đ</span></li>
                        <li>Eco Tax <span>22.000 đ</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>22.000 đ</span></li>
                        @endif

                    </ul>

                    <a class="btn btn-default update login_checkout" href="{{ route('checkout.cart') }}">Check Out</a>
                </div>
            </div>
        </div>
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
                let quantity_product = $(this).closest('.cart_quantity_button').find('.cart_quantity_product').val();

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
                let sub_total = $(this).closest('body').find('.total_area #sub_total').text();
                let stringsubtotal = '';
                for (let i = 0; i < sub_total.split('.').length; i++) {
                    stringsubtotal += sub_total.split('.')[i];
                }
                let price_sub_total = stringsubtotal.split('đ')[0];
                //
                let total = $(this).closest('body').find('.total_area #total').text();

                $.ajax({
                    type: "get",
                    url: _url,
                    data: {
                        id: id,
                        quantity_product:quantity_product
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

                                that.closest('body').find('.total_area #sub_total').text(number_subtotal + ' đ');
                                that.closest('body').find('.total_area #total').text(total_tax + ' đ');

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
                let sub_total = $(this).closest('body').find('.total_area #sub_total').text();
                let stringsubtotal = '';
                for (let i = 0; i < sub_total.split('.').length; i++) {
                    stringsubtotal += sub_total.split('.')[i];
                }
                let price_sub_total = stringsubtotal.split('đ')[0];
                //
                let total = $(this).closest('body').find('.total_area #total').text();


                    if(parseInt(quantity-1) < 1)
                {
                    if(confirm('Bạn có muốn xoá sản phẩm '+name+' này không')){

                        check;
                        let stringnumbersubtotal = (parseInt(price_sub_total) - parseInt(prices)).toString();
                        let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                        "$1.").toString();
                        that.closest('body').find('.total_area #sub_total').text(number_subtotal + ' đ');
                        let stringtotal = ((parseInt(price_sub_total) - parseInt(prices)) + parseInt(22000)).toString();

                        let total_tax = (stringtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                        "$1.").toString();
                        that.closest('body').find('.total_area #total').text(total_tax + ' đ');

                        $(this).closest('tr').remove();

                    }else{
                        check = 1;
                        //hiển thị giá ở sub total
                        let stringnumbersubtotal = (parseInt(price_sub_total)).toString();
                        let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                "$1.").toString();
                        that.closest('body').find('.total_area #sub_total').text(number_subtotal + ' đ');
                    }
                }else{
                    let stringnumbersubtotal = (parseInt(price_sub_total) - parseInt(prices)).toString();
                    let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                    "$1.").toString();
                    that.closest('body').find('.total_area #sub_total').text(number_subtotal + ' đ');

                    let stringtotal = ((parseInt(price_sub_total) - parseInt(prices)) + parseInt(22000)).toString();
                    let total_tax = (stringtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                    "$1.").toString();
                    that.closest('body').find('.total_area #total').text(total_tax + ' đ');
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
                let sub_total = $(this).closest('body').find('.total_area #sub_total').text();
                let stringsubtotal = '';
                for (let i = 0; i < sub_total.split('.').length; i++) {
                    stringsubtotal += sub_total.split('.')[i];
                }
                let price_sub_total = stringsubtotal.split('đ')[0];
                //
                let total = $(this).closest('body').find('.total_area #total').text();


                //remove
                let stringnumbersubtotal = (parseInt(price_sub_total) - (parseInt(prices) * parseInt(quantity))).toString();
                let number_subtotal = (stringnumbersubtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                "$1.").toString();
                that.closest('body').find('.total_area #sub_total').text(number_subtotal + ' đ');

                let stringtotal = ((parseInt(price_sub_total) - (parseInt(prices) * parseInt(quantity))) + parseInt(22000)).toString();
                let total_tax = (stringtotal).replace(/(\d)(?=(\d{3})+(?!\d))/g,
                "$1.").toString();
                that.closest('body').find('.total_area #total').text(total_tax + ' đ');

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
            $(".login_checkout").click(function (e) {
                e.preventDefault();
                let checkLogin = "{{ auth()->check() }}";
               let url = '{{ route('frontend.login.register') }}';
               let checkout = '{{ route('checkout.cart') }}';
                if (checkLogin) {
                    window.location.replace(checkout);
                } else {
                    Swal.fire('Vui lòng đăng nhập mới thực hiện chức năng này');
                    setTimeout(function(){
                        window.location.replace(url);
                    }, 3000);
                }
            });
        });
</script>
@endsection
