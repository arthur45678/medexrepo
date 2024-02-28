<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
            <span class="c-header-toggler-icon"></span>
        </button>
        <a class="c-header-brand d-sm-none" href="#">
            <img class="c-header-brand" src="/assets/brand/coreui-base.svg" width="97" height="46" alt="MedEx Logo">
        </a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true">
            <span class="c-header-toggler-icon"></span>
        </button>
        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-1">
                <a class="c-header-nav-link" href="/">Գլխավոր</a>
            </li>
            <li class="c-header-nav-item px-1">
                <a class="c-header-nav-link" href="{{url('/departments/structure')}}">Կառուցվածք</a>
            </li>
        </ul>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item mx-2 c-d-legacy-none">
                <button class="c-class-toggler c-header-nav-btn c-header-nav"  type="button" id="header-tooltip" data-target="body"
                    data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title=""
                    data-original-title="Toggle Light/Dark Mode">
                    <x-svg icon="cui-moon" class="c-d-dark-none" />
                    <x-svg icon="cui-sun" class="c-d-default-none" />
                </button>
            </li>

            <li class="c-header-nav-item d-md-down-none mx-2" id="received-referrals"></li>

            {{-- @include('shared.referrals.sent') --}}

            {{-- <li class="c-header-nav-item d-md-down-none mx-2">
                <a href="#" class="c-header-nav-link">
                    <x-svg icon="cui-list-rich" />
                </a>
            </li> --}}
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="{{asset("/assets/img/avatars/avatar.png")}}"
                            alt="user@email.com" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <strong>Հաշիվ</strong>
                    </div>
                    <a class="dropdown-item" href="{{ route('referrals.patients.received') }}">
                        <x-svg icon="cui-bell" class="mr-2" />
                        Ստացվածներ<span class="badge badge-info ml-auto" id="receivedReferralsCount">0</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('referrals.patients.sent') }}">
                        <x-svg icon="cui-envelope-open" class="mr-2" />
                        Ուղարկվածներ<span class="badge badge-success ml-auto" id="sentReferralsCount">0</span>
                    </a>
                    <div class="dropdown-header bg-light py-2">
                        <strong>Կարգավորումներ</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <x-svg icon="cui-user" class="mr-2" /> {{auth()->user()->full_name ?? "" }}
                    </a>
                    <a class="dropdown-item" href="{{route('users.changeUserPassword')}}">
                        <x-svg icon="cui-settings" class="mr-2" />Փոխել գաղտնաբառը
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{route("logout")}}" method="POST">
                        <button type="submit" class="btn btn-ghost-dark btn-block">
                        <div class="p-1">
                            <x-svg icon="cui-account-logout" class="mr-2" />
                                @csrf
                                Դուրս գալ
                        </div>
                        </button>
                    </form>
                </div>
            </li>
            <!-- settings-button -->
            {{-- <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside"
                data-class="c-sidebar-show">
                <x-svg icon="cui-settings" />
            </button> --}}
        </ul>
        <div class="c-subheader px-3">
            <ol class="breadcrumb border-0 m-0">
                <li class="breadcrumb-item"><a href="/">Գլխավոր</a></li>
                <?php $segments = ''; ?>
                @for($i = 1; $i <= count(Request::segments()); $i++) <?php $segments .= '/'. Request::segment($i); ?>
                    @if($i < count(Request::segments())) <li class="breadcrumb-item">{{ Request::segment($i) }}</li>
                    @else
                    <li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
                    @endif
                @endfor
            </ol>
        </div>
    </header>
