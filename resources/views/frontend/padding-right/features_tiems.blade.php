<div class="features_items">
    <h2 class="title text-center">Features Items</h2>
    @forelse ($products as $product)
    @if($product->quantity < 1)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <form action="" method="post">
                    @csrf
                    <div class="productinfo text-center">
                        <img src="{{ asset($product['feature_image_path']) }}" width="268" height="249"
                            style="object-fit: cover; object-position: center" alt="" />
                        <h2> {{number_format(str_replace(',','',$product['price']) * (100 -
                            $product['sale'])/100,0,'','.') }} đ </h2>
                        <p>{{ $product['name'] }}</p>

                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <p>{{ 'Tạm thời hết hàng' }}</p>
                            <h2>{{number_format(str_replace(',','',$product['price']) * (100 -
                                $product['sale'])/100,0,'','.') }} đ</h2>
                            <p>{{ $product['name'] }}</p>
                            <a data-id="{{ $product['id'] }}" class="btn btn-default add-to-cart" disabled><i
                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>

                    @if ($product['sale'] == 0)
                    <img src="{{ asset('frontend/eshopper/images/home/new.png') }}" class="new" alt="">
                    @else
                    <img src="{{ asset('frontend/eshopper/images/home/sale.png') }}" class="sale" alt="">
                    @endif

                </form>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a
                            href="{{ route('frontend.product.details',['slug'=> $product['slug'], 'id'=>$product['id']]) }}"><i
                                class="fa fa-plus-square"></i>Products Detalis</a></li>
                </ul>
            </div>
        </div>
    </div>

@else
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <form action="" method="post">
                @csrf
                <div class="productinfo text-center">
                    <img src="{{ asset($product['feature_image_path']) }}" width="268" height="249"
                        style="object-fit: cover; object-position: center" alt="" />
                    <h2> {{number_format(str_replace(',','',$product['price']) * (100 -
                        $product['sale'])/100,0,'','.') }} đ </h2>
                    <p>{{ $product['name'] }}</p>

                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                        cart</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format(str_replace(',','',$product['price']) * (100 -
                            $product['sale'])/100,0,'','.') }} đ</h2>
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

            </form>
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                <li><a href="{{ route('frontend.product.details',['slug'=> $product['slug'], 'id'=>$product['id']]) }}"><i
                            class="fa fa-plus-square"></i>Products Detalis</a></li>
            </ul>
        </div>
    </div>
</div>
@endif

@empty
<div class="col-sm-12">
    <div class="product-image-wrapper">
        <p style="text-align: center; font-size: 20px; ">Chưa có sản phẩm nào cho danh mục này</p>
    </div>
</div>
@endforelse

</div>
