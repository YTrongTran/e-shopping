<div class="product-details">
    <div class="col-sm-5">
        <div class="view-product">
            <ul id="imageGallery">
                <li data-thumb="{{ asset($productId->feature_image_path) }}"
                    data-src="{{ asset($productId->feature_image_path) }}">
                    <img src="{{ asset($productId->feature_image_path) }}" width="100%" height="380"
                        style="object-fit: cover" alt="">
                </li>
                @forelse ($productId->product as $item)

                <li data-thumb="{{ asset($item['image_path']) }}" data-src="{{ asset($item['image_path']) }}"
                    class="carousel-inner">
                    <img src="{{ asset($item['image_path']) }}" width="329" height="380" style="object-fit: cover" />
                </li>

                @empty
                <li data-thumb="" data-src="">
                    <img src="" width=" 329" height="380" style="object-fit: cover" alt="Image_slider_products" />
                </li>
                @endforelse

            </ul>

        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>


    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            @if ($productId['sale'] == 0)
            <img src="{{ asset('frontend/eshopper/images/product-details/new.jpg') }}" class="newarrival" alt="">
            @endif
            <h2>{{ $productId->name }}</h2>
            <p>Web ID: {{ $productId->id }}</p>
            <img src="{{ asset('frontend/eshopper/images/product-details/rating.png') }}" alt="">
            <span>
                <span class="span_price">{{ $productId->price }} đ</span>
                <label>Quantity:</label>
                <input type="number" name="price" min="1" value="1" class="input_number">
                @if ($productId->quantity < 1) <button data-id="{{ $productId->id }}" disabled type="button"
                    class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                    </button>
                    @else
                    <button data-id="{{ $productId->id }}" type="button" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                    @endif

            </span>
            <p><b>Tình trạng:</b> {{ ($productId->quantity < 1)? 'hết hàng' : 'còn hàng' }}</p>
                    <p><b>Trạng thái:</b> {{ ($productId['sale'] == 0) ? 'New':'Sale' }}</p>
                    <p><b>Thương hiệu:</b> {{ $productId->brand->name }}</p>
                    <p><b>Danh mục:</b> {{ $productId->category->name }}</p>
                    <a href=""><img src="{{ asset('frontend/eshopper/images/product-details/share.png') }}"
                            class="share img-responsive" alt=""></a>
        </div>
        <!--/product-information-->
    </div>
</div>


<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
            <li><a href="#tag" data-toggle="tab">Tag</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details">
            <div class="col-sm-12">
                <div class="product-content-wrapper" style="max-height: 300px;overflow: scroll;">
                    {!! $productId->content !!}

                </div>
            </div>

        </div>


        <div class="tab-pane fade" id="tag">
            <div class="col-sm-12">
                <div class="product-tag-wrapper">

                    @forelse ($productId->tags()->get() as $tag )
                    {{ $tag->name }} <br>
                    @empty
                    <p>Hiện chưa có tags cho sản phẩm này</p>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="tab-pane fade active in" id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name">
                        <input type="email" placeholder="Email Address">
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="{{ asset('frontend/eshopper/images/product-details/rating.png') }}"
                        alt="">
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
