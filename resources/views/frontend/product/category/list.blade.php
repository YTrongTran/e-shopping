@extends('frontend.layouts.master')
@section('title')
    <title>Category | E-Shopper</title>
@endsection

@section('content')


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

@endsection
