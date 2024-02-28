<?php
$sps = $stationary->stationary_present_status;
$sps_approvementStatusBoolean = !is_null($sps) ? $sps->approvementStatusBoolean() : "";
$sps_classname = $sps_approvementStatusBoolean === false ? 'waiting-for-approvement' : "" ;
// $classname = $stationary->stationary_present_status->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;

$sps_approvementStatus = !is_null($sps) ? $sps->approvementStatus() : "";
?>
<div class="new-page">
    <div class="{{$sps_classname}}">
        <div id="stationary-present-status" class="text-center"><strong>Status praesens subjectivus et objecivus</strong></div>
    </div>
        <br><br>
        <div><strong>Հիվանդի ընդհանուր վիճակը</strong></div>
        <p>
            {{$stationary->stationary_present_status->patient_general_condition ?? ""}}
        </p>
        <br>
        <div>Ըստ Կարնոֆսկու սանդղակի</div>
        <p>
            {{$stationary->stationary_present_status->by_karnowski_scale ?? ""}}
        </p>
        <br>
        <div>Գիտակցությունը</div>
        <p>
            {{$stationary->stationary_present_status->consciousness ?? ""}}
        </p>
        <br>
        <div>Դիրքը անկողնում -
            <span class="bottom-line">{{($stationary->stationary_present_status && $stationary->stationary_present_status->position_in_bed) ? __("enums.position_in_bed_enum." . $stationary->stationary_present_status->position_in_bed) : ""}}</span>
        </div>
        <br><br>
        <div><strong> Մազածածկույթները -</strong>
            <span class="bottom-line">
                {{($stationary->stationary_present_status && $stationary->stationary_present_status->skin_coverings) ? __("enums.skin_coverings_enum." . $stationary->stationary_present_status->skin_coverings) : ""}}
            </span>
        </div>
        <br>
        <div>Ենթամաշկային ճարպաշերտը -
            <span class="bottom-line">
                {{($stationary->stationary_present_status && $stationary->stationary_present_status->subcutaneous_fat) ? __("enums.subcutaneous_fat_enum." . $stationary->stationary_present_status->subcutaneous_fat) : ""}}
            </span>
        </div>
        <br>
        <div class="float-left"> Ճարպակալում</div>
        <div class="bottom-line float-left">{{$stationary->bmi ?? ""}} - {{$stationary->nutritional_status ?? ""}}</div>
        <br><br><br>
        <div>Ստորին վերջույթների ենթամաշկային երակների վարիկոզ լայնացում
            {{optional($stationary->stationary_present_status)->varicose_of_lower_extremities ? '(այո)' : '(ոչ)' ?? ""}}</div>
        <p>
            {{$stationary->stationary_present_status->varicose_of_lower_extremities_comment ?? ""}}
        </p>
        <br>
        <div>Ավշային հանգույցներ</div>
        <p>
            {{$stationary->stationary_present_status->lymph_node ?? ""}}
        </p>
        <br>
        <div>Հենաշարժիչ համակարգ</div>
        <p>
            {{$stationary->stationary_present_status->propulsion_system ?? ""}}
        </p>
        <br>
        <div>Նյարդային համակարգ</div>
        <p>
            {{$stationary->stationary_present_status->nervous_system ?? ""}}
        </p>
        <br>
        <div>Կրծքագեղձեր</div>
        <p>
            {{$stationary->stationary_present_status->breasts ?? ""}}
        </p>
        <br><br>
        <div><strong>Շնչառական համակարգ</strong></div>
        <br>
        <div>Գանգատներ</div>
        <p>
            {{$stationary->stationary_present_status->respiratory_complaints ?? ""}}
        </p>
        <br>
        <div>Շնչառությունը -
            <span class="bottom-line">
                {{($stationary->stationary_present_status && $stationary->stationary_present_status->breathing_type) ? __("enums.breathing_type_enum." . $stationary->stationary_present_status->breathing_type) : ""}}
            </span>
        </div>
        <br>
        <div>Թոքերի բախում</div>
        <p>
            {{$stationary->stationary_present_status->lung_collision ?? ""}}
        </p>
        <br>
        <div>Լսում</div>
        <p>
            {{$stationary->stationary_present_status->listening_breathing ?? ""}}
        </p>
        <br>
        <div>Շնչառական շարժումների հաճախականությունը(1 րոպեում)</div>
        <p>
            {{$stationary->stationary_present_status->respiratory_movements_frequency_per_minute ?? ""}}
        </p>
        <br><br>
        <div><strong>Սիրտ-անոթային համակարգ</strong></div>
        <br>
        <div>Գանգատներ</div>
        <p>
            {{$stationary->stationary_present_status->cardiovascular_complaints ?? ""}}
        </p>
        <br>

        <div>Սրտի պերկուտոր սահմանները</div>
        <p>
            {{$stationary->stationary_present_status->heart_percutaneous_border ?? ""}}
        </p>
        <br>

        <div>Սրտի լսում</div>
        <p>
            {{$stationary->stationary_present_status->heartbeat ?? ""}}
        </p>
        <br>
        <div>Անոթազարկ</div>
        <p>
            {{$stationary->stationary_present_status->vascular_stroke ?? ""}}
        </p>
        <br>
        <div class="float-left">Զարկերակային ճնշում (սիստոլիկ / դիաստոլիկ)</div>
        <div class="bottom-line float-left short_line">
            {{$stationary->stationary_present_status->blood_pressure_systolic ?? "--"}} /
            {{$stationary->stationary_present_status->blood_pressure_diastolic ?? "--"}}
        </div> mmHG
        <br><br><br>
        <div><strong>Էնդոկրին համակարգ</strong></div>
        <p>
            {{$stationary->stationary_present_status->endocrine_system ?? ""}}
        </p>
        <br>
        <div>LOR-օրգաններ</div>
        <p>
            {{$stationary->stationary_present_status->lor_organs ?? ""}}
        </p>
        <br><br>
        <div><strong>Մարսողական համակարգ</strong></div>
        <br>
        <div>Գանգատներ</div>
        <p>
            {{$stationary->stationary_present_status->digestive_complaints ?? ""}}
        </p>
        <div>Լեզուն -
            <span class="bottom-line">
                {{($stationary->stationary_present_status && $stationary->stationary_present_status->tongue_state) ? __("enums.tongue_state_enum." . $stationary->stationary_present_status->tongue_state) : ""}}
            </span>
        </div>
        <br>
        <div>Կլման ակտ -
            <span class="bottom-line">
                {{($stationary->stationary_present_status && $stationary->stationary_present_status->act_of_absorption) ? __("enums.act_of_absorption_enum." . $stationary->stationary_present_status->act_of_absorption) : ""}}
            </span>
        </div>
        <p>{{$stationary->stationary_present_status->absorption_difficulty_degree ?? ""}}</p>
        <br>
        <div>Որովայնը՝ -
            @if ($stationary->stationary_present_status->spleen_is_enlarged ?? "")
                (համաչափ,
            @else
                (անհամաչափ,
            @endif

            @if ($stationary->stationary_present_status->spleen_is_enlarged ?? "")
                շնչառությանը մասնակցում է)
            @else
                շնչառությանը չի մասնակցում)
            @endif
        </div>
        <p>
            {{$stationary->stationary_present_status->pain_when_touching_abdomen_comment ?? ""}}
        </p>
        <br>
        {{-- <span class="print-hide">{{$stationary->stationary_present_status->approvementStatus()}}</span> --}}
        <span class="print-hide">{{$sps_approvementStatus}}</span>
        <br><br>

</div>
