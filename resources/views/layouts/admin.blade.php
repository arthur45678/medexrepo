<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="MedEx">
    <meta name="author" content="Webex">
    <meta name="keyword" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>MedEx</title>
    {{-- <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png"> --}}
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png"> --}}
    {{-- <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png"> --}}
    <link rel="manifest" href="{{asset("/assets/favicon/manifest.json")}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ mix('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    {{-- <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
    <!-- icons --> --}}
<!-- Main styles for this application-->
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/pace.min.css') }}" rel="stylesheet">

    @yield('css')
    @stack('css-additional')
</head>



<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    @include('shared.admin.nav-admin')
    @include("shared.admin.aside")
    @include('shared.admin.header')


    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
    </div>
    @include('shared.footer')
</div>



<!-- CoreUI and necessary plugins-->
<script src="{{ mix('js/pace.min.js') }}"></script>
<script src="{{ mix('/js/coreui.bundle.min.js') }}"></script>
<script src="{{ mix('/js/components/manifest.js') }}"></script>
<script src="{{ mix('/js/components/vendor.js') }}"></script>
@yield('javascript')
@stack('javascript-additional')
</body>

</html>
