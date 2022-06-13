@extends('frontend.layouts.master')
@section('title')
<title>Home | E-Shopper</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@include('frontend.Components.slider')

<section>
    <div class="container">
        <div class="row">
            @include('frontend.container.left-sidebar')

            <div class="col-sm-9 padding-right">
                @include('frontend.padding-right.features_tiems')
                @include('frontend.padding-right.category-tab')
                @include('frontend.padding-right.recommended_items')
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
        let stringPrices = price.trim().split(".");
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
