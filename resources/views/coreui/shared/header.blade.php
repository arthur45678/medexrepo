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
                <a class="c-header-nav-link" href="/">Ձևամնուշներ</a>
            </li>
            <li class="c-header-nav-item px-1">
                <a class="c-header-nav-link" href="/">Կառուցվածք</a>
            </li>
        </ul>
        <ul class="c-header-nav ml-auto mr-4">
            {{-- <li class="c-header-nav-item px-3 c-d-legacy-none">
                <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body"
                    data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title=""
                    data-original-title="Toggle Light/Dark Mode">
                    <x-svg icon="cui-moon" class="c-d-dark-none" />
                    <x-svg icon="cui-sun" class="c-d-default-none" />
                </button>
            </li> --}}
            <li class="c-header-nav-item dropdown d-md-down-none mx-2 show">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="true">
                    <x-svg icon="cui-bell" />
                    <span class="badge badge-pill badge-info">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                    <div class="dropdown-header"><strong>You have 7 messages</strong></div><a class="dropdown-item"
                        href="#">
                        <div class="message">
                            <div class="py-3 mfe-3 float-left">
                                <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/7.jpg"
                                        alt="user@email.com"><span class="c-avatar-status bg-success"></span></div>
                            </div>
                            <div><small class="text-muted">John Doe</small><small
                                    class="text-muted float-right mt-1">Just
                                    now</small></div>
                            <div class="text-truncate font-weight-bold"><span class="text-danger">!</span> Important
                                message</div>
                            <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit,
                                sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item" href="#">
                        <div class="message">
                            <div class="py-3 mfe-3 float-left">
                                <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/6.jpg"
                                        alt="user@email.com"><span class="c-avatar-status bg-warning"></span></div>
                            </div>
                            <div><small class="text-muted">John Doe</small><small class="text-muted float-right mt-1">5
                                    minutes
                                    ago</small></div>
                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                            <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit,
                                sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item" href="#">
                        <div class="message">
                            <div class="py-3 mfe-3 float-left">
                                <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/5.jpg"
                                        alt="user@email.com"><span class="c-avatar-status bg-danger"></span></div>
                            </div>
                            <div><small class="text-muted">John Doe</small><small
                                    class="text-muted float-right mt-1">1:52
                                    PM</small></div>
                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                            <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit,
                                sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item" href="#">
                        <div class="message">
                            <div class="py-3 mfe-3 float-left">
                                <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/4.jpg"
                                        alt="user@email.com"><span class="c-avatar-status bg-info"></span></div>
                            </div>
                            <div><small class="text-muted">John Doe</small><small
                                    class="text-muted float-right mt-1">4:03
                                    PM</small></div>
                            <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                            <div class="small text-muted text-truncate">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit,
                                sed do eiusmod tempor incididunt...</div>
                        </div>
                    </a><a class="dropdown-item text-center border-top" href="#"><strong>View all messages</strong></a>
                </div>
            </li>
            <li class="c-header-nav-item d-md-down-none mx-2">
                <a href="#" class="c-header-nav-link">
                    <x-svg icon="cui-list-rich" />
                    <span class="badge badge-danger">3</span>
                </a>
            </li>
            <li class="c-header-nav-item d-md-down-none mx-2">
                <a href="#" class="c-header-nav-link">
                    <x-svg icon="cui-envelope-open" />
                    <span class="badge badge-primary badge-pill">3</span>
                </a>
            </li>
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="{{asset("/assets/img/avatars/avatar.svg")}}"
                            alt="user@email.com" />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <strong>Հաշիվ</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <x-svg icon="cui-bell" class="mr-2" />
                        Ստացածներ<span class="badge badge-info ml-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <x-svg icon="cui-envelope-open" class="mr-2" />
                        Ուղարկվածներ<span class="badge badge-success ml-auto">42</span>
                    </a>
                    <div class="dropdown-header bg-light py-2">
                        <strong>Կարգավորումներ</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                        <x-svg icon="cui-user" class="mr-2" /> Արթուր Միքայելյան
                    </a>
                    <a class="dropdown-item" href="#">
                        <x-svg icon="cui-settings" class="mr-2" /> Փոխել գաղտնաբառը
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <x-svg icon="cui-account-logout" class="mr-2" />
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-ghost-dark btn-block">Դուրս գալ</button>
                        </form>
                    </a>
                </div>
            </li>
            <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside"
                data-class="c-sidebar-show">
                <x-svg icon="cui-settings" />
            </button>
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
