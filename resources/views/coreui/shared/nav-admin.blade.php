<div class="c-sidebar-brand" style="background-color:white;">
    <img class="c-sidebar-brand-full" src="{{asset("assets/brand/medex.svg")}}" width="118" height="46"
        alt="MedEx Logo" />
    <img class="c-sidebar-brand-minimized" src="{{asset("assets/brand/coreui-signet-white.svg")}}" width="118"
        height="46" alt="MedEx" />
</div>
<ul class="c-sidebar-nav">

    <!-- Բոլորը -->
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="#">
            <x-svg icon="cui-medical-cross" sidebarIcon="true" />
            Բաժիններ
        </a>
    </li>

    <!-- Տնօրեն, գլխ․ և այլ բժիշկներ, կադրեր -->
    <!-- չունի դեղատունը -->
    <li class="c-sidebar-nav-title">Հիվանդներ</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="#">
            <x-svg icon="cui-people" sidebarIcon="true" />
            Հիվանդներ
        </a>
    </li>

    <!-- Բոլորը -->
    <li class="c-sidebar-nav-title">Ձեվանմուշներ</li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <x-svg icon="cui-file" sidebarIcon="true" /> Ձևանմուշներ
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <input type="search" class="form-control" placeholder="Որոնում․․․" />
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/buttons/buttons">
                    Փասթաթղութ 1
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/buttons/buttons">
                    Փասթաթղութ 2
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="/buttons/buttons">
                    Փասթաթղութ 3
                </a>
            </li>
        </ul>
    </li>

    <!-- Կադրերի բաժին -->
    <li class="c-sidebar-nav-title">Կադրեր</li>
    <li class="c-sidebar-nav-item ">
        <a class="c-sidebar-nav-link" href="#">
            <x-svg icon="cui-user" sidebarIcon="true" />
            Աշխատակիցների տվյալներ
        </a>
    </li>

    <!-- հաշվապահ, Դրամարկղ -->
    <li class="c-sidebar-nav-title">Դրամարկղ</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="#">
            <x-svg icon="cui-wallet" sidebarIcon="true" />
            Դրամարկղ
        </a>
    </li>

    <!-- Տնօրեն -->
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

    <!-- Տնօրեն, հաշվապահ, Ավագ քույր -->
    <li class="c-sidebar-nav-title">Դեղորայք</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="#">
            <x-svg icon="cui-healing" sidebarIcon="true" />
            Դեղորայքի մնացորդ
        </a>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
    data-class="c-sidebar-minimized">
</button>
</div>
