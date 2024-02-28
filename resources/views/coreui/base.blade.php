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
    <title>MedEx</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ mix('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    {{-- <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet">
    <!-- icons --> --}}
    <!-- Main styles for this application-->
    <link href="{{ mix('css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/pace.min.css') }}" rel="stylesheet">

    @yield('css')

    <!-- Global site tag (gtag.js) - Google Analytics-->
    {{-- <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script> --}}

    {{-- <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet"> --}}
</head>



<body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

        @include('coreui.shared.nav-admin')
        @include("coreui.shared.aside")
        @include('coreui.shared.header')


        <div class="c-body">

            <main class="c-main">

                @yield('content')
                <div class="director-back-img"></div>

                <!-- չունեն ընդունարանը, դրամարկղը, Հաշվապահը, Ավագ քույրը, դեղատունը -->
                <x-absolute.icon-bottom title='' xpos="left border-light" icon="cui-calendar"
                    iconClass="c-x64 text-light" type="svg" />
                <x-absolute.icon-bottom title='' xpos="right border-light" icon="cil-paper-plane"
                    iconClass="c-x64 text-light" />
            </main>
        </div>
        @include('coreui.shared.footer')
    </div>



    <!-- CoreUI and necessary plugins-->
    <script src="{{ mix('js/pace.min.js') }}"></script>
    <script src="{{ mix('js/coreui.bundle.min.js') }}"></script>

    @yield('javascript')




</body>

</html>
