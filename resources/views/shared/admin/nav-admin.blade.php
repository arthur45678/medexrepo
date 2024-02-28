<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-full" src="{{asset("assets/brand/medex.svg")}}" width="118" height="46"
        alt="MedEx Logo" />
    <img class="c-sidebar-brand-minimized" src="{{asset("assets/brand/m-signet.svg")}}" width="118" height="46"
        alt="MedEx" />
</div>
<ul class="c-sidebar-nav">

    <li class="c-sidebar-nav-title">Պաշտոններ</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.roles.index')}}">
            <x-svg icon="cui-people" sidebarIcon="true" />
            Պաշտոններ
        </a>
    </li>

    <li class="c-sidebar-nav-title">Անձնակազմ</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.users.index')}}">
            <x-svg icon="cui-people" sidebarIcon="true" />
            Անձնակազմ
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.departments.index')}}">
            <x-svg icon="cui-medical-cross" sidebarIcon="true" />
            Բաժիններ
        </a>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.logs.index')}}">
            <x-svg icon="cui-medical-cross" sidebarIcon="true" />
            Լոգ
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.medicine-lists.index')}}">
            <x-svg icon="cui-medical-cross" sidebarIcon="true" />
            Դեղորայքի անուներ
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('admin.administrative-staff.index')}}">
            <x-svg icon="cui-medical-cross" sidebarIcon="true" />
            Վարչական անձնակազմ
        </a>
    </li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle">
            <x-svg icon="cui-clipboard" sidebarIcon="true" />
            Ցանկեր
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.dinisase-list.index')}}">
                    Հիվանդություններ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.treatment-list.index')}}">
                    Բուժման տեսակներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.anesthesia-list.index')}}">
                    Անզգայացման տեսակներ
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.payment_card.index')}}">
                    Վճարման տեսակներ
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.service-list.index')}}">
                    Ծառայություններ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.stage-list.index')}}">
                    Կլինիկական փուլ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.surgery-list.index')}}">
                    Վիրահատություններ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.tumor-treatment-list.index')}}">
                    Ուռուցքի բուժուման տեսակներ
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.histological-lists.index')}}">
                    Հյուսվածքաբանական նշումներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.currentStage-lists.index')}}">
                    Ընթացիկ փուլ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.exit-lists.index')}}">
                    Հիվանդության ելքեր
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.researches-lists.index')}}">
                    Հետազոտություններ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.ApplicationPurpose-lists.index')}}">
                    Դիմումների տեսակներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.Metastasis-lists.index')}}">
                    Մետասթազներ
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.chamber-lists.index')}}">
                    Պալատներ
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.bed-lists.index')}}">
                    Մահճակալներ
                </a>
            </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.health-sample-lists.index')}}">
                    Բուժական ձևանմնուշներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.education-lists.index')}}">
                    Կրթություն
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.lab-service-lists.index')}}">
                    Լաբորատոր ծառայության
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.marital-status-lists.index')}}">
                    Ամուսնական կարգավիճակ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.scholarships-lists.index')}}">
                    Կրթաթոշակներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.social-living-condition-lists.index')}}">
                    Սոցիալական կենսապայմանների
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.working-feature-lists.index')}}">
                    Աշխատանքային հատկանիշներ
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('admin.age-lists.index')}}">
                    Տարիքային ցուցակ
                </a>
            </li>
        </ul>
    </li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
    data-class="c-sidebar-minimized">
</button>
</div>
