@extends('frontend.layouts.master')
@section('title')
<title>Products Details | E-Shopper</title>
@endsection

@section('content')


<section>
    <div class="container">
        <div class="row">
            @include('frontend.container.left-sidebar')

            <div class="col-sm-9 padding-right">
                @include('frontend.padding-right.product-details')
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
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(document).ready(function () {
        $('.cart').click(function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).closest('.product-information').find('h2').text();
            let quantity = $(this).closest('.product-information').find('.input_number').val();
            let image = $(this).closest('.product-details').find('.view-product img').attr('src');
            let price = $(this).closest('.product-details').find('.span_price').text();
            //xử lý giá tiền
            let string = price.split(",");
            let sum_prices = '';
            for(let i = 0; i < string.length; i++ )
            {
                sum_prices += string[i];
            }
            let prices = sum_prices.split("đ")[0];
            let _url = '{{ URL::Route("ajax.addToCart") }}';
            let cart =  $(this).closest('body').find('#cart_count').text();
            console.log(cart);
            let that = $(this);
            $.ajax({
                type: "POST",
                url: _url,
                data: {
                    id:id,
                    name:name,
                    image:image,
                    price:prices,
                    quantity:quantity,
                },
                dataType: "json",
                success: function (response) {
                  if(response.code == 200)
                  {
                    that.closest('body').find('#cart_count').text(response.count);
                    Swal.fire(response.messager);
                  }
                }
            });
        });
    });

    //ảnh silder
    $(document).ready(function() {
        $('#imageGallery').lightSlider({
            gallery:true,
            item:1,
            loop:true,
            thumbItem:3,
            slideMargin:0,
            enableDrag: false,
            currentPagerPosition:'left',
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }
        });

  });
</script>
@endsection
