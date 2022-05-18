<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Nice lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Nice admin lite design, Nice admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Nice Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   @yield('title')
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template-admin/assets/images/favicon.png') }}">
    <link href="{{ asset('template-admin/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template-admin/dist/css/style.min.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body>

    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">

        @include('admin.components.logo_left')
        @include('admin.components.menu_bar_left')

        <div class="page-wrapper">
          @yield('content')
            @include('admin.components.footer')
        </div>

    </div>


    <script src="{{ asset('template-admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('template-admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template-admin/assets/extra-libs/sparkline/sparkline.js' ) }}"></script>
    <script src="{{ asset('template-admin/dist/js/waves.js' ) }}"></script>
    <script src="{{ asset('template-admin/dist/js/sidebarmenu.js' ) }}"></script>
    <script src="{{ asset('template-admin/dist/js/custom.min.js' ) }}"></script>
    <script src="{{ asset('template-admin/assets/libs/chartist/dist/chartist.min.js' ) }}"></script>
    <script src="{{ asset('template-admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js' ) }}"></script>
    <script src="{{ asset('template-admin/dist/js/pages/dashboards/dashboard1.js' ) }}"></script>
    @section('js')

    @endsection
</body>

</html>
