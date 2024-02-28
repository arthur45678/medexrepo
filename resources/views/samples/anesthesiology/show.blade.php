<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ԱՆԵՍԹԵԶԻՈԼՈԳԻ ՆԱԽԱՎԻՐԱՀԱՏԱԿԱՆ ԶՆՆՈՒՄ</title>
    <link rel="stylesheet" href="{{mix('css/print/stationary.css')}}">

    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif

</head>
<body>

<?php

use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryMedicineSideEffectEnum as MedSideEffect;
use App\Enums\StationarySurgeryEnum;

use App\Enums\Samples\SampleDiagnosesEnum;
use App\Enums\Samples\SampleTreatmentsEnum;

?>
<div class="page-wrap">
    <br><br>
    <div class="main-container">
        <div class="text-center"><strong>ԱՆԵՍԹԵԶԻՈԼՈԳԻ ՆԱԽԱՎԻՐԱՀԱՏԱԿԱՆ ԶՆՆՈՒՄ</strong> </div>
        <br><br>
        <div class="float-left">Հիվանդի Ա․Ա․Հ․</div>
        <div class="bottom-line float-left">{{$patient->fullname}}</div>
        <div class="float-left margin-left">Հ․Պ․ N</div>
        <div class="bottom-line float-left">{{$lates_stationary->id ?? ' '}}</div>
        <br><br>
        <div class="float-left">Տարիքը</div>
        <div class="bottom-line float-left short_line">{{$patient->age}}</div>
        <div class="float-left margin-left">Սեռը</div>
        <div class="bottom-line float-left short_line">@if($patient->is_male==0) Իգական
        @elseԱրական@endif</div>
        <br><br>
        <div class="float-left">Մարմնի կառ․</div>
        <div class="bottom-line float-left">{{$apse->body_structure}}</div>
        <div class="float-left margin-left">Քաշը</div>
        <div class="bottom-line float-left ">{{$apse->weight}}</div>
        <br><br>
        <div>Ախտորոշումը</div>
        @foreach($anestologia_a as $diagnos_exits)
        <p>{{$diagnos_exits->disease_name->name ?? ' '}} <br>{{$diagnos_exits->surgeries_comment}}

        </p>
        @endforeach

        <div>Գանգատները</div>
        <p>{{$apse->complaints}}</p>
        <br>
        <div>Նախատեսվ․ վիրահատ․</div>

        <p>{{$apse->surgerylists->name ?? ' '}}</p>
        <div>{{$apse->surgeries_comment}}</div>
        <br>
        <div class="float-left">Բժշկի ստորագրությունը</div>
        <div class="float-left bottom-line">{{$apse->attending_doctor->full_name}}</div>
        <br><br><br><br>
        <div class="text-center"><strong>Օբյեկտիվ քննություն</strong> </div>
        <br><br>
        <div>Գիտակցությունը</div>
        <p>{{$apse->consciousness}}</p>
        <br>
        <div>Մաշկը և տես․ լորձաթաղ․</div>
        <p>{{$apse->the_skin}}</p>
        <br>
        <div>Սիրտանոթային համակարգը՝ ԱՃ</div>
        <p>{{$apse->cardiovascular_system}}</p>
        <br>
        <div>Սրտի կծկումների հաճ․ զ/ր</div>
        <p>{{$apse->heart_contraction}}</p>
        <br>
        <div>Աուսկուլտացիա</div>
        <p>{{$apse->auscultation}}</p>
        <br>
        <div>ԷՄԳ</div>
        <p>{{$apse->veins}}</p>
        <br>
        <div>Շնչառական համակարգ Շնչ․ հաճ․</div>
        <p>{{$apse->respiratory_system}}</p>
        <br>
        <div>Բերանի խոռոչ</div>
        <p>{{$apse->oral}}</p>
        <br>
        <div class="float-left">Mallampati</div>

        <div class="bottom-line float-left">
            @if($apse->mallampati == 1)
                I
            @elseif($apse->mallampati == 2)
                II
            @elseif($apse->mallampati == 3)
                III
            @elseif($apse->mallampati == 4)
                IV
            @endif
        </div>
        <br><br><br>
        <div>Այլ օրգան համակարգեր</div>
        <p>{{$apse->other_organ_systems}}</p>
        <br>
        <div>ՈՒղեկցող հիվանդություններ</div>
        @foreach($anestologia_b as $diagnos_exits_b)

            <p>{{$diagnos_exits_b->disease_name->name ?? ' '}}
            {{$diagnos_exits_b->surgeries_comment}}</p>

        @endforeach
        <br>

        <div>Ներկայումս ստացող բուժում</div>
        @foreach($anestologia_c as $diagnos_exits_c)
            <p>{{$diagnos_exits_c->treatment_name->name ?? ' '}}
                <br>{{$diagnos_exits_c->surgeries_comment}}</p>
        @endforeach
        <br>
        <div>Լաբորատոր հետազոտություններ</div>
        <p>{{$apse->laboratory_tests}}</p>
        <br><br><br>
        <div class="text-center"><strong>Անամնեզ</strong>  </div>
        <br>
        <div>Ալերգիկ</div>
        <p>{{$apse->allergic}}</p>
        <br>
        <div>Վիրաբուժական</div>
        <p>{{$apse->surgical}}</p>
        <br>
        <div>Կրած հիվանդություններ</div>
        @foreach($anestologia_d as $diagnos_exits_d)
            <td>{{$diagnos_exits_d->disease_name->name ?? ' '}}<br>{{$diagnos_exits_d->surgeries_comment}}</td>
        @endforeach
        <br>
        <div>Վնասակար սովորություններ՝ ծխել ալկոհոլ</div>
        @foreach($anestologia_e as $diagnos_exits_e)
            <p>{{$diagnos_exits_e->disease_name->name ?? ' '}}<br>{{$diagnos_exits_e->surgeries_comment}}</p>
        @endforeach
        <br>
        <div>Հատուկ Նշումներ</div>
        <p>{{$apse->special_notes}}</p>
        <br><br><br>
        <div class="float-left">Հիվանդի վիճակը ըստ ASA </div>
        <div class="bottom-line float-left">
            @if($apse->ASA == 1)
                I
            @elseif($apse->ASA == 2)
                II
            @elseif($apse->ASA == 3)
                III
            @elseif($apse->ASA == 4)
                IV
            @elseif($apse->ASA == 5)
                V
            @elseif($apse->ASA == 6)
                E
            @endif

        </div>
        <br><br><br>
        <div class="text-center"><strong>ԱՆԶԳԱՅԱՑՄԱՆ ՀԱՄԱՁԱՅՆԱԳԻՐ</strong> </div>
        <br>
        <div class="float-left">Ես տալիս եմ իմ համաձայնությունը անզգայացման</div>
        <div class="bottom-line float-left"></div> մեթոդին։
        <br><br>
        <div>Բժիշկը մանրամասնորեն բացատրել է ինձ տվյալ գործողության բնույթը և նպատակը, տեղյակ է պահել սպասվող արդյունքների և հնարավոր բարդությունների մասին։ Զգուծացրել է ինչպես նախապատրաստվել անզգայացմանը։</div>
        <br>
        <div>Ես լիովին տեղեկացրել եմ բժշկին ներկայում և նախկինում կրած բոլոր հիվանդությունների մասին։</div>
        <br>
        <div class="float-left">Անզգայացման տեսակը</div>
        <div class="bottom-line float-left">{{$apse->anesthesia_id}}</div>
        <br><br>
        <div class="float-left">Հիվանդ/խնամակալ/ազգական</div>
        <div class="bottom-line float-left">{{$apse->patient_guardian_relative}}</div>
        <br><br><br>
        <div class="float-left">Անեսթեզիոլոգ</div>
        <div class="bottom-line float-left">{{$apse->attending_doctor->full_name ?? ' '}}</div>
        <br><br><br><br><br><br>
     </div>
</div>
</body>
</html>
