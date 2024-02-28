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
</head>

<body class="{{auth()->user()->background}}">
@include('shared.header')
<main class="c-main container" style="margin-top: 140px">
    <div class="row">

        <div class="col-sm-6 col-md-3">
            <a class="structure-block-a" href="{{$is_moderator ? route('admin.departments.index') :route('departments.list')}}">
                <div class="card">
                    <div class="card-header structure-block sb-departments">
                        Բաժիններ
                    </div>
                    <div class="card-body" style="cursor:pointer;">
                        <img style="margin-left:36%" src="/assets/icons/structure/sheeld.png" width="60" height="auto">
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-md-3">
            @if (auth()->user()->hasAnyPermission(['view all-patients', 'view patients']))
                <a class="structure-block-a" href="{{route('patients.index')}}">
                    <div class="card">
                        <div class="card-header structure-block sb-patients">
                            Հիվանդներ
                        </div>
                        <div class="card-body" style="cursor:pointer;">
                            <img style=" margin-left:36%" src="/assets/icons/structure/user.png" width="60" height="auto">
                        </div>
                    </div>
                </a>
            @else
                <div class="card">
                    <div class="card-header structure-block-disabled">
                        Հիվանդներ
                    </div>
                    <div class="card-body">
                        <img style=" margin-left:36%" src="/assets/icons/structure/user.png" width="60" height="auto">
                    </div>
                </div>
            @endif
        </div>

        <div class="col-sm-6 col-md-3">
            @if (auth()->user()->hasAnyPermission(['view medicines','search medicines']))
                <a class="structure-block-a" href='{{ route("pharmacy.pharmacy.index") }}'>
                    <div class="card">
                        <div class="card-header structure-block sb-medicines">
                            Դեղորայք
                        </div>
                        <div class="card-body" style="cursor:pointer;">
                            <img style=" margin-left:36%" src="/assets/icons/structure/sheet.png" width="60" height="auto">
                        </div>
                    </div>
                </a>
            @else
                <div class="card">
                    <div class="card-header structure-block-disabled">
                        Դեղորայք
                    </div>
                    <div class="card-body">
                        <img style=" margin-left:36%" src="/assets/icons/structure/sheet.png" width="60" height="auto">
                    </div>
                </div>
            @endif
        </div>

        <div class="col-sm-6 col-md-3">
            @if (!$is_moderator)
                <a class="structure-block-a" href='{{ route("otherSamples.parentOtherSamples.index") }}'>
                    <div class="card">
                        <div class="card-header structure-block sb-samples">
                            Ձևանմուշներ
                        </div>
                        <div class="card-body" style="cursor:pointer;">
                            <img style="margin-left:36%" src="/assets/icons/structure/send.png" width="60" height="auto">
                        </div>
                    </div>
                </a>
            @else
                <div class="card">
                    <div class="card-header structure-block-disabled">
                        Ձևանմուշներ
                    </div>
                    <div class="card-body">
                        <img style="margin-left:36%" src="/assets/icons/structure/send.png" width="60" height="auto">
                    </div>
                </div>
            @endif

        </div>

        <div class="col-sm-6 col-md-3">
            @if (auth()->user()->hasAnyPermission(['view warehouse-items']))
                <a class="structure-block-a" href='{{route("wareHouse.warehouses.index")}}'>
                    <div class="card">
                        <div class="card-header structure-block sb-warehouse">
                            Պահեստ
                        </div>
                        <div class="card-body" style="cursor:pointer;">
                            <img style=" margin-left:36%" src="/assets/icons/structure/pahest.png" width="80" height="auto">
                        </div>
                    </div>
                </a>
            @else
            <div class="card">
                <div class="card-header structure-block-disabled">
                    Պահեստ
                </div>
                <div class="card-body">
                    <img style=" margin-left:36%" src="/assets/icons/structure/pahest.png" width="80" height="auto">
                </div>
            </div>
            @endif
        </div>

        <div class="col-sm-6 col-md-3">
            @if (auth()->user()->hasAnyPermission(['view reports']))
                <a class="structure-block-a" href="#reports">
                    <div class="card">
                        <div class="card-header structure-block sb-reports">
                            Հաշվետվություն
                        </div>
                        <div class="card-body" style="cursor:pointer;">
                            <img style=" margin-left:36%" src="/assets/icons/structure/hashv.png" width="71" height="auto">
                        </div>
                    </div>
                </a>
            @else
                <div class="card">
                    <div class="card-header structure-block-disabled">
                        Հաշվետվություն
                    </div>
                    <div class="card-body">
                        <img style=" margin-left:36%" src="/assets/icons/structure/hashv.png" width="71" height="auto">
                    </div>
                </div>
            @endif
        </div>

        <div class="col-sm-6 col-md-3">
            @if (auth()->user()->hasAnyPermission(['view cashboxes', 'view cashboxes 1', 'view cashboxes 2', 'view cashboxes 3', 'view cashboxes 4']))
                @php
                    $cashbox_route = route('cashbox.cashboxFirst.orderinput.index');
                    if (auth()->user()->can('view cashboxes 2')) {
                        $cashbox_route = route('cashbox.cashboxSecond.orderinput.index');
                    } elseif (auth()->user()->can('view cashboxes 3')) {
                        $cashbox_route = route('cashbox.cashboxThirth.orderinput.index');
                    }elseif (auth()->user()->can('view cashboxes 4')) {
                        $cashbox_route = route('cashbox.cashboxFour.orderinput.index');
                    }
                @endphp
                <a class="structure-block-a" href='{{$cashbox_route}}'>
                    <div class="card">
                        <div class="card-header structure-block sb-cashboxes">
                            Դրամարկղ
                        </div>
                        <div class="card-body" style="cursor:pointer;">
                            <img style=" margin-left:36%" src="/assets/icons/structure/dram.png" width="63" height="auto">
                        </div>
                    </div>
                </a>
            @else
                <div class="card">
                    <div class="card-header structure-block-disabled">
                        Դրամարկղ
                    </div>
                    <div class="card-body">
                        <img style=" margin-left:36%" src="/assets/icons/structure/dram.png" width="63" height="auto">
                    </div>
                </div>
            @endif
        </div>


        <div class="col-sm-6 col-md-3">
            @if (!$is_moderator)
            <a class="structure-block-a" href='{{route("nonmedical-referrals.create")}}'>
                <div class="card">
                    <div class="card-header structure-block sb-referrals">
                        Ուղեգրեր
                    </div>
                    <div class="card-body" style="cursor:pointer;">
                        <img style="margin-left:36%" src="/assets/icons/structure/arxiv.png" width="68" height="auto">
                    </div>
                </div>
            </a>
            @else
            <div class="card">
                <div class="card-header structure-block-disabled">
                    Ուղեգրեր
                </div>
                <div class="card-body">
                    <img style="margin-left:36%" src="/assets/icons/structure/arxiv.png" width="68" height="auto">
                </div>
            </div>
            @endif
        </div>


    </div>
</main>

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
