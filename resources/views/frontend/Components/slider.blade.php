<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($sliders as $key => $value )

                        <div class="item {{ ($key == 0) ? 'active' : ' ' }}">
                            <div class="col-sm-6">
                                <h2>{{ $value['name'] }}</h2>
                                <p>{{ $value['description'] }} </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ asset($value['name_image_path']) }}" width="484" height="441"
                                    style="object-fit: cover" class="girl img-responsive" alt="" />
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @if(!empty($sliders))
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
