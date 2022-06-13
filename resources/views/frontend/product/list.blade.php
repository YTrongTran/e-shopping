@extends('frontend.layouts.master')
@section('title')
<title>Products | E-Shopper</title>
@endsection

@section('content')

<section>
    <div class="container">
        <div class="row">
            @include('frontend.container.left-sidebar')

            <div class="col-sm-9 padding-right">

                <div class="features_items">
                    <h2 class="title text-center">Features Items</h2>

                    <form action="{{ route('frontend.product.search') }}" method="get">
                        @csrf
                        <div class="seach_advan" style="display: flex; margin: 10px;">
                            <input style="padding: 5px; margin: 5px;" type="text" name="name" placeholder="Name"
                                class="form-control" id="">
                            <select name="price" id="" class="form-control" style="padding: 5px; margin: 5px;">
                                <option value="">Choose price</option>
                                <option value="100000-500000">100.000 - 500.000</option>
                                <option value="500000-1000000">500.000 - 1.000.000</option>
                                <option value="1000000-10000000">1.000.000 - 10.000.000</option>
                                <option value="10000000-50000000">10.000.000 - 50.000.000</option>
                                <option value="50000000-100000000">50.000.000 - 100.000.000</option>
                                <option value="100000000-100000000000000">100.000.000 - trên</option>
                            </select>
                            <select name="category" id="" class="form-control" style="padding: 5px; margin: 5px;">
                                <option value="">Category</option>
                                @foreach ($categorys as $category)
                                @if ($category->categoryChilds->count())
                                @foreach ($category->categoryChilds as $key => $value)
                                <option value="{{  $value['id'] }}">{{ $value['name'] }}</option>
                                @endforeach
                                @endif
                                @endforeach
                            </select>
                            <select name="brand" id="" class="form-control" style="padding: 5px; margin: 5px;">
                                <option value="">Brand</option>
                                @foreach ($brands as $key => $value )
                                <option value="{{  $value['id'] }}">{{ $value['name'] }}</option>
                                @endforeach

                            </select>
                            <select name="sale" id="" class="form-control" style="padding: 5px; margin: 5px;">
                                <option value="">Status</option>
                                <option value="0">New</option>
                                <option value="1">Sale</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger" style="margin:0 0 15px 15px;">Search</button>
                    </form>
                    @foreach ($products as $product)
                    @if ($product->quantity < 1) <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset($product['feature_image_path']) }}" width="268" height="249"
                                        style="object-fit: cover; object-position: center" alt="" />

                                    <h2> {{number_format(str_replace(',','',$product['price']) * (100 -
                                        $product['sale'])/100,0,'',',') }} đ </h2>
                                    <p>{{ $product['name'] }}</p>
                                    <a data-id="{{ $product['id'] }}" class=" btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to
                                        cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <p>{{ 'Tạm thời hết hàng' }}</p>
                                        <h2>
                                            {{number_format(str_replace(',','',$product['price']) * (100 -
                                            $product['sale'])/100,0,'',',') }} đ </h2>
                                        <p>{{ $product['name'] }}</p>
                                        <a data-id="{{ $product['id'] }}" class="btn btn-default add-to-cart"
                                            disabled><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                                @if ($product['sale'] == 0)
                                <img src="{{ asset('frontend/eshopper/images/home/new.png') }}" class="new" alt="">
                                @else
                                <img src="{{ asset('frontend/eshopper/images/home/sale.png') }}" class="sale" alt="">
                                @endif

                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a
                                            href="{{ route('frontend.product.details',['slug'=> $product['slug'],'id'=>$product['id'] ]) }}"><i
                                                class="fa fa-plus-square"></i>Products Detalis</a></li>
                                </ul>
                            </div>
                        </div>
                </div>
                @else
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset($product['feature_image_path']) }}" width="268" height="249"
                                    style="object-fit: cover; object-position: center" alt="" />

                                <h2> {{number_format(str_replace(',','',$product['price']) * (100 -
                                    $product['sale'])/100,0,'',',') }} đ </h2>
                                <p>{{ $product['name'] }}</p>
                                <a data-id="{{ $product['id'] }}" class=" btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to
                                    cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>
                                        {{number_format(str_replace(',','',$product['price']) * (100 -
                                        $product['sale'])/100,0,'',',') }} đ </h2>
                                    <p>{{ $product['name'] }}</p>
                                    <a data-id="{{ $product['id'] }}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                            @if ($product['sale'] == 0)
                            <img src="{{ asset('frontend/eshopper/images/home/new.png') }}" class="new" alt="">
                            @else
                            <img src="{{ asset('frontend/eshopper/images/home/sale.png') }}" class="sale" alt="">
                            @endif

                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a
                                        href="{{ route('frontend.product.details',['slug'=> $product['slug'],'id'=>$product['id'] ]) }}"><i
                                            class="fa fa-plus-square"></i>Products Detalis</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                @endforeach

            </div>

            {{ $products->links() }}
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
    $(".add-to-cart").click(function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        let quantity = 1;
        let image = $(this).closest(".single-products").find("img").attr("src");
        let name = $(this)
            .closest(".single-products")
            .find(".productinfo p")
            .text();
        let price = $(this)
            .closest(".single-products")
            .find(".productinfo h2")
            .text();


        // xử lý cắt chuỗi giá tiền
        let stringPrices = price.split(",");
        let arrayPrice = "";
        for (let i = 0; i < stringPrices.length; i++) {
            arrayPrice += stringPrices[i];
        }
        // xử lý xong giá tiền mình cần lấy thằng nay
        let prices = parseInt(arrayPrice.split("đ")[0]);


        let _url = '{{ route("ajax.addToCart") }}';
        $.ajax({
            type: "POST",
            url: _url,
            data: {
                id: id,
                image: image,
                name: name,
                price: prices,
                quantity: quantity
            },
            dataType: "json",
            success: function (response) {
                if(response.code == 200)
                {

                    $('#cart_count').text(response.count);
                    Swal.fire(response.messager);
                }
            },
        });
    });
});

</script>
@endsection
