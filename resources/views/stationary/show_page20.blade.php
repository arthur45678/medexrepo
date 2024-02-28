<?php
# red frame for unnapproved
$ste = $stationary->stationary_treatment_evaluation;
$ste_approvementStatusBoolean = !is_null($ste) ? $ste->approvementStatusBoolean() : "";
$ste_classname = $ste_approvementStatusBoolean === false ? 'waiting-for-approvement' : "" ;
// $classname = $stationary->stationary_pathological_anatomical->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;

# show evaluation message or ""
$ste_ecog = !is_null($ste) ? $ste->eastern_cooperative_oncology_group->getValue() : "";
$ste_kf = !is_null($ste) ? $ste->karnofsky_performance->getValue() : "";
$ste_te = !is_null($ste) ? $ste->treatment_effectiveness->getValue() : "";
?>

<div class="new-page">
    <div class="main-container">
        <div id="stationary_treatment_evaluation" class="text-center">
            <div class="{{$ste_classname}}">
                <strong>ՖՈՒՆԿՑԻՈՆԱԼ ՎԻՃԱԿԻ ԳՆԱՀԱՏՈՒՄՆ ԸՍՏ՝<br>
                    Easter Cooperative Oncology Group-ի սանդղակի
                </strong>
            </div>
        </div>
        <p>
            @if ($ste_ecog)
                {{__("enums.eastern_cooperative_oncology_group_enum.$ste_ecog") }}
            @endif
            {{-- {{__("enums.eastern_cooperative_oncology_group_enum." . optional(optional($stationary->stationary_treatment_evaluation)->eastern_cooperative_oncology_group)->getValue()) ?? ""}} --}}
        </p>
        <br>
        <div class="text-center">
            <div class="{{$ste_classname}}">
                <strong>ԿԱՐՆՈՎՍԿՈՒ ԳՈՐԾՈՒՆԱԿՈՒԹՅԱՆ ՍԱՆԴՂԱԿ՝<br>
                    (Kamofsky performance scale)
                </strong>
            </div>
        </div>
        <p>
            @if ($ste_kf)
                {{__("enums.karnofsky_performance_enum.$ste_kf") }}
            @endif
            {{-- {{__("enums.karnofsky_performance_enum." . optional(optional($stationary->stationary_treatment_evaluation)->karnofsky_performance)->getValue()) ?? ""}} --}}
        </p>
        <br>

        <div class="text-center">
            <div class="{{$ste_classname}}">
                <strong>ԲՈՒԺՄԱՆ ԱՐԴՅՈՒՆԱՎԵՏՈՒԹՅՈՒՆ</strong>
            </div>
        </div>
        <p>
            @if ($ste_te)
                {{__("enums.treatment_effectiveness_enum.$ste_te") }}
            @endif
            {{-- {{__("enums.treatment_effectiveness_enum." .optional(optional($stationary->stationary_treatment_evaluation)->treatment_effectiveness)->getValue()) ?? ""}} --}}
        </p>
        <br><br><br>
    </div>
</div>
