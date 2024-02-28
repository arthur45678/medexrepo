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
    {{-- <meta name="csrf_token" content="{{csrf_token()}}"> --}}
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

    {{-- Pass vairables to JS --}}
    <script>
        window.Laravel = {};
        window.Laravel.user = @json(auth()->user());
    </script>
    <style>
        .phpdebugbar-restore-btn{
          width:5px !important;
            height: 5px !important;
        }
    </style>
</head>



<body class="{{auth()->user()->background}}">
    <audio id="notification-audio" src="{{ asset('/audio/swiftly.mp3') }}" muted></audio>
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

        @include('shared.nav-admin')
        {{-- aside showing when we click on the settings of header --}}
        {{-- @include("shared.aside") --}}
        @include('shared.header')

        <div class="c-body" style="background-image:url({{asset('assets/img/avatars/samples/background.png')}}); background-size: cover;background-attachment: fixed;
    background-position: bottom;">
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
    <script src="{{ mix('/js/broadcast.js') }}"></script>
    <script src="{{ mix('/js/components/ReceivedReferrals.js') }}"></script>

    @yield('javascript')
    @stack('javascript-additional')
    <script>
        $('#header-tooltip').click(function (){
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{url('change/Background')}}',
                type:"get",
                success: function (data) {
                    console.log(data);
                }
            });
        })

        $.getJSON("/referrals/patients/received",{'getCount': 1}, function(data) {
            const {receivedReferralsCount = 0} = data;
           $('#receivedReferralsCount') && $('#receivedReferralsCount').text(receivedReferralsCount);
        });

        $.getJSON("/referrals/patients/sent", {'getCount':1}, function(data) {
            const {sentReferralsCount = 0} = data;
            $('#sentReferralsCount') && $('#sentReferralsCount').text(sentReferralsCount);
        });
    </script>
</body>

</html>
