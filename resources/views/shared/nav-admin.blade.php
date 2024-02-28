<div class="c-sidebar-brand" style=" background-image: linear-gradient(white, #3F9D94);">
    <img class="c-sidebar-brand-full" src="{{asset("assets/brand/medex.svg")}}" width="118" height="46"
        alt="MedEx Logo" />
    <img class="c-sidebar-brand-minimized" src="{{asset("assets/brand/m-signet.svg")}}" width="118" height="46"
        alt="MedEx" />
</div>
<ul class="c-sidebar-nav" style=" background-image: linear-gradient(#3F9D94, #2B6C65);">

    <!-- Բոլորը -->
    {{-- <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('departments.list')}}">
            <x-svg icon="cui-medical-cross" sidebarIcon="true" />
            Բաժիններ
        </a>
    </li> --}}

    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <x-svg icon="cui-medical-cross" sidebarIcon="true" />
            Բաժին
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('departments.list')}}">
                    <span class="c-sidebar-nav-icon"></span> Բաժիններ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('otherSamples.departments.work-time-bulletins.index', ['department'=>auth()->user()->department_id])}}">
                    <span class="c-sidebar-nav-icon"></span>
                    Աշխ ․ժամ․ տեղեկագրեր
                </a>
            </li>
        </ul>
    </li>

    <!-- Տնօրեն, գլխ․ և այլ բժիշկներ, կադրեր -->
    <!-- չունի դեղատունը -->
    @can('view patients')
    {{-- <li class="c-sidebar-nav-title">Հիվանդներ</li> --}}
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('patients.index')}}">
            <x-svg icon="cui-people" sidebarIcon="true" />
            Հիվանդներ
        </a>
    </li>
    @endcan

    <!-- Ընդունակարան (araqsya.poghosyan)։ Առցանց հերթեր -->
    @role('receptionist')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('reception_queues.index')}}">
            <x-svg icon="cui-list-numbered" sidebarIcon="true" />
            Առցանց հերթեր
        </a>
    </li>
    @endrole

    <!-- Բոլորը -->
    {{-- <li class="c-sidebar-nav-title">Ձեվանմուշներ</li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <x-svg icon="cui-file" sidebarIcon="true" /> Ձևանմուշներ
        </a>
        <div data-items="@json(['Document', 'Hello', 'World'])">
        @php
        $items = ['document', 'hello', 'world'];
        @endphp
        <ul id="list" class="c-sidebar-nav-dropdown-items" data-items="{{json_encode($items)}}"></ul>
        </div>
    </li> --}}

    <!-- Բոլորը բուժական գծով -->
    @if (!auth()->user()->hasAnyRole(['department_head', 'department_registrar']))
    <li class="c-sidebar-nav-title">Փաստաթղթեր</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('referrals.patients.received')}}">
            <x-svg icon="cui-cloud-download"/>
            <x-svg icon="cui-bed" sidebarIcon="true"/>
            Ստացածներ
        </a>
        <a class="c-sidebar-nav-link" href="{{route('referrals.patients.sent')}}">
            <x-svg icon="cui-cloud-upload"/>
            <x-svg icon="cui-bed" sidebarIcon="true"/>
            Ուղարկվածներ
        </a>
    </li>
    @endif

    {{-- @if (auth()->user()->hasAnyRole(['department_head', 'department_registrar'])) --}}
    @hasanyrole('department_head|department_registrar')
    <li class="c-sidebar-nav-dropdown">
        <p class="ml-3 text-muted">բաժնի վարիչ</p>
        <a class="c-sidebar-nav-dropdown-toggle" href="#">
            <x-svg icon="cui-cloud-download" />
            <x-svg icon="cui-bed" sidebarIcon="true"/>
            Ստացածներ
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('referrals.patients.received.not_assigned')}}">
                    Բաժին
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('referrals.patients.received.assigned')}}">
                    Բժիշկներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('referrals.patients.received')}}">
                    Անձնական
                </a>
            </li>
        </ul>
    </li>
    {{-- @endif --}}
    @endhasanyrole

    @role('department_head')
    <li class="c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-dropdown-toggle" href="#">
            <x-svg icon="cui-cloud-upload"/>
            <x-svg icon="cui-bed" sidebarIcon="true"/>
            Ուղարկվածներ
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('referrals.patients.sent_others')}}">
                    Բժիշկներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('referrals.patients.sent')}}">
                    Անձնական
                </a>
            </li>
        </ul>
    </li>
    @endrole

    @hasanyrole('department_head|department_registrar')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href='{{route("departments.queues", auth()->user()->department_id)}}'>
                <x-svg icon="cui-list-numbered" sidebarIcon="true" />
                Հերթագրում
            </a>
        </li>
    @endhasanyrole

    @hasrole('doctor')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href='{{ route("departments.queue", auth()->user()->department_id) }}'>
                <x-svg icon="cui-list-numbered" sidebarIcon="true" />
                Հերթացուցակ
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href='{{ route("referrals.patients.services") }}'>
                <x-svg icon="cui-list-numbered" sidebarIcon="true" />
                Ծառայություններ
            </a>
        </li>
    @endhasrole

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href='{{ route("otherSamples.parentOtherSamples.index") }}'>
            <x-svg icon="cui-calendar" sidebarIcon="true" />
          Այլ ձևանմուշներ
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href='{{ route("nonmedical-referrals.create") }}'>
            <x-svg icon="cui-list-numbered" sidebarIcon="true" />
            Ուղեգրեր
        </a>
    </li>


    <!-- Կադրերի բաժին -->
    @can('view users')
    <li class="c-sidebar-nav-title">Կադրեր</li>
    <li class="c-sidebar-nav-item ">
        <a class="c-sidebar-nav-link" href="{{route('users.index')}}">
            <x-svg icon="cui-user" sidebarIcon="true" />
            Անձնակազմ
        </a>
    </li>

    @endcan

    <!-- հաշվապահ, Դրամարկղ -->
    @canany(['view cashboxes 1','view cashboxes'])
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{route('cashbox.cashboxFirst.orderinput.index')}}">
                <x-svg icon="cui-user" sidebarIcon="true" />
                Դրամարկղ 1
            </a>
        </li>
    @endcan

    @canany(['view cashboxes 2','view cashboxes'])
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{ route('cashbox.cashboxSecond.orderinput.index') }}">
                <x-svg icon="cui-user" sidebarIcon="true" />
                Դրամարկղ 2
            </a>
        </li>
    @endcan

    @canany(['view cashboxes 3','view cashboxes'])
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{ route('cashbox.cashboxThirth.orderinput.index') }}">
                <x-svg icon="cui-user" sidebarIcon="true" />
                Դրամարկղ 3
            </a>
        </li>
    @endcan

    @canany(['view cashboxes 4','view cashboxes'])
        <li class="c-sidebar-nav-item ">
            <a class="c-sidebar-nav-link" href="{{ route('cashbox.cashboxFour.orderinput.index') }}">
                <x-svg icon="cui-user" sidebarIcon="true" />
                Դրամարկղ 4
            </a>
        </li>
    @endcan


    <!-- Պահեստ -->
    @can('view warehouse-items')
    <li class="c-sidebar-nav-title">Պահեստ</li>
    <li class="c-sidebar-nav-item ">
        <a class="c-sidebar-nav-link" href="{{route('wareHouse.warehouses.index')}}">
            <x-svg icon="cui-rectangle" sidebarIcon="true" />
            Պահեստ
        </a>
    </li>
    @endcan

    <li class="c-sidebar-nav-item ">
        <a class="c-sidebar-nav-link" href="{{route('calendar.index')}}">
            <x-svg icon="cui-rectangle" sidebarIcon="true" />
            Օրացույց
        </a>
    </li>


    <!-- Տնօրեն -->
    @can('view reports')
    <li class="c-sidebar-nav-title">Հաշվետվություններ</li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <x-svg icon="cui-clipboard" sidebarIcon="true" />
            Հաշվետվություններ
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <input type="search" class="form-control" placeholder="Որոնում․․․" />
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/buttons/buttons">
                    Հաշվետվություն 1
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/buttons/buttons">
                    Հաշվետվություն 2
                </a>
            </li>
        </ul>
    </li>
    @endcan

    <!-- Տնօրեն, հաշվապահ, Ավագ քույր -->
    @can('view medicines')
    <li class="c-sidebar-nav-title">Դեղորայք</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route("pharmacy.pharmacy.index") }}">
            <x-svg icon="cui-healing" sidebarIcon="true" />
            Դեղորայքի մնացորդ
        </a>
    </li>
    @endcan

    <!-- Արխիվ -->
    @can('view archives')
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <x-svg icon="cui-clipboard" sidebarIcon="true" />
            Արխիվ
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('archivepatients')}}">
                    Արխիվ
                </a>
            </li>
        </ul>
    </li>
    @endcan





</ul>
<button class="c-sidebar-minimizer c-class-toggler" style="background:  #2C6E67;" type="button" data-target="_parent"
    data-class="c-sidebar-minimized">
</button>
</div>
