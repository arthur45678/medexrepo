<?php 
use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryMedicineSideEffectEnum as MedSideEffect;
use App\Enums\StationarySurgeryEnum;
?>

    <div>Որովայնամիզային ախտանշանները՝
        <span class="bottom-line">
            {{($stationary->stationary_present_status && $stationary->stationary_present_status->abdominal_urinary_symptom) ? __("enums.abdominal_urinary_symptom_enum." . $stationary->stationary_present_status->abdominal_urinary_symptom) : ""}}
        </span>
    </div>
    <p>
        {{$stationary->stationary_present_status->abdominal_urinary_symptom_comment ?? ""}}
    </p>
    <br>
    <div class="float-left">Լյարդը ՝ 
      
        {{optional($stationary->stationary_present_status)->liver_is_enlarged ? '(մեծացած է)' : '(մեծացած չէ)'}} 
    </div> 
    <div class=" float-left">
        {{$stationary->stationary_present_status->liver_size ?? ""}}
    </div>սմ 
        <span class="bottom-line">
            {{($stationary->stationary_present_status && $stationary->stationary_present_status->liver_type) ? __("enums.liver_and_spleen_type_enum." . $stationary->stationary_present_status->liver_type) : ""}}
        </span>
    <br>
    <br>
    <div class="float-left">Փայծախը ՝ 
        {{ optional($stationary->stationary_present_status)->spleen_is_enlarged ? '(մեծացած է)' : '(մեծացած չէ)'}} 
    </div>
    <div class="float-left">
        {{$stationary->stationary_present_status->spleen_size ?? ""}} 
    </div>սմ 
        <span class="bottom-line">
            {{($stationary->stationary_present_status && $stationary->stationary_present_status->spleen_type) ? __("enums.liver_and_spleen_type_enum." . $stationary->stationary_present_status->spleen_type) : ""}}
        </span>
    <br>
    <br>
    <div>Աղիքային պերիստալտիկան - 
        <span class="bottom-line">
            {{($stationary->stationary_present_status && $stationary->stationary_present_status->intestinal_peristalsis) ? __("enums.intestinal_peristalsis_enum." . $stationary->stationary_present_status->intestinal_peristalsis) : ""}}
        </span>
    </div>
    <br>
    <div><strong>Միզասեռական համակարգ</strong></div>
    <br>
    <div>Գանգատներ</div> 
    <p>
        {{optional($stationary->stationary_present_status)->urogenital_complaints ?? ""}} 
    </p>
    <br>
    <div>Միզարձակումը՝ 
        <span class="bottom-line">
            {{($stationary->stationary_present_status && $stationary->stationary_present_status->urination_type) ? __("enums.urination_type_enum." . $stationary->stationary_present_status->urination_type) : ""}}
        </span>
    </div> 
    <br>
    <div>Բաշխման ախտանշանը՝ 
        {{optional($stationary->stationary_present_status)->symptom_of_urogenital_distribution ? '(բացասական)' : '(դրական)' ?? ""}}
        
    <p>
        {{optional($stationary->stationary_present_status)->symptom_of_urogenital_distribution_comment ?? ""}}
    </p>
    <br>
    <br>
    <div><strong><u>Status localis (Locus morbi)</u></strong></div>
    <p>
        {{optional($stationary->stationary_present_status)->status_localis ?? ""}}
    </p>
    <br>
    <div id="stationary_diagnosis_stationary_present_status_preliminary">Նախնական ախտորոշումը</div>
    <p>
        {{$stationary->stationary_diagnoses->where('diagnosis_type', StationaryDiagnosisEnum::stationary_present_status_preliminary())->last()->diagnosis_comment ?? ""}}
    </p>
    <br><br>
    <div><strong>Հետազոտության ծրագիր</strong></div>
    <div></div>
    <div></div>

    @php
        $sps = $stationary->stationary_present_status;
        $examination_program = optional($sps)->examination_program_array ?? [];
    @endphp
    @if(count($examination_program))

        @if ($filtered_not_ultrasoundable = array_filter($examination_program["not_ultrasoundable"]))
            @foreach ($filtered_not_ultrasoundable as  $item)
                <p>{{__("enums.examination_type_enum.$item") ?? ""}}</p>
                
            @endforeach    
        @else 
            <p></p>
        @endif

        @if ($filtered_ultrasoundable = array_filter($examination_program["ultrasoundable"]))
            <div><strong>Ուլտրաձայնային՝</strong></div>
            @foreach ($filtered_ultrasoundable as  $item)
                <p>{{__("enums.ultrasoundable_body_part_enum.$item") ?? ""}}</p>
            @endforeach    
        @else 
            <p></p>
        @endif

        @if ($filtered_other = array_filter($examination_program["other"]))
            <div><strong>Այլ՝</strong></div>
            @foreach ($filtered_other as  $item)
                <p>{{$item ?? ""}}</p>
            @endforeach    
        @else 
            <p></p>
        @endif

        @endif
        <br><br>
        <div class="float-left">Բժշկի ազգանունը և ստորագրությունը</div>
        <div class="bottom-line float-left data">{{$item->user->full_name ?? ""}}</div>
        <br><br><br><br><br>
    </div>
