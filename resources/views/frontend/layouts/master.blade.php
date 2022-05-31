<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')
    <link href="{{ asset('frontend/eshopper/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/eshopper/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/eshopper/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/eshopper/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/eshopper/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/eshopper/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/eshopper/css/responsive.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('frontend/eshopper/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/eshopper/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/eshopper/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/eshopper/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/eshopper/images/ico/apple-touch-icon-57-precomposed.png') }}">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @yield('css')

</head>

<body>
    @include('frontend.Components.header')

        @yield('content')

    @include('frontend.Components.footer')

    <script src="{{ asset('frontend/eshopper/js/jquery.js')}}"></script>
	<script src="{{ asset('frontend/eshopper/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('frontend/eshopper/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{ asset('frontend/eshopper/js/price-range.js')}}"></script>
    <script src="{{ asset('frontend/eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('frontend/eshopper/js/main.js')}}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    @yield('js')
</body>
</html>
