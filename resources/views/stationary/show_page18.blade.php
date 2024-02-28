<?php
use App\Enums\StationaryDiagnosisEnum;
$spa = $stationary->stationary_pathological_anatomical;
$spa_approvementStatusBoolean = !is_null($spa) ? $spa->approvementStatusBoolean() : "";
$spa_classname = $spa_approvementStatusBoolean  === false ? 'waiting-for-approvement' : "" ;
// $classname = $stationary->stationary_pathological_anatomical->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;
$spa_approvementStatus = !is_null($spa) ? $spa->approvementStatus() : "";
?>

<div class="new-page">
    <div class="main-container">
        <br><br>
        <div class="{{$spa_classname}}">
            <div id="spa_diagnosis" class="text-center">
                <strong>ԱԽՏԱԲԱՆԱ-ԱՆԱՏՈՄԻԱԿԱՆ ԱԽՏՈՐՈՇՈՒՄ</strong>
            </div>
        </div>
        <br>
        {{-- <span class="print-hide">{{$stationary->stationary_pathological_anatomical->approvementStatus()}}</span> --}}
        <span class="print-hide">{{$spa_approvementStatus}}</span>
        <br><br>
        <br><br>
        <div class="display-flex float-left">
            <div>Ամսաթիվ</div>
            <div class="bottom-line">{{$stationary->stationary_pathological_anatomical->autopsy_date ?? ""}}</div>
        </div>
        <div class="float-left">
            <div class="float-left margin-left">Արձանագրության #</div>
            <div class="bottom-line float-left">{{$stationary->stationary_pathological_anatomical->autopsy_protocol ?? ""}}</div>
        </div>

            <br><br>
        <div id="spa_primary_disease" >ա.հիմնական հիվանդություն</div>
        <p>
        @forelse($stationary->stationary_diagnoses->where("diagnosis_type", StationaryDiagnosisEnum::primary_disease()) as $item)
            {{$item->disease_item->code_name ?? ""}}  <br>
            {{$item->diagnosis_comment ?? ""}} <br><br>
            @empty

        @endforelse
        </p>
        <br>
        <div id="spa_primary_disease_complication" >բ.բարդություն</div>
        <p>
        @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",
            StationaryDiagnosisEnum::disease_complication()) as $item)
                {{$item->disease_item->code_name ?? ""}} <br>
                {{$item->diagnosis_comment ?? ""}} <br><br>
                @empty

        @endforelse
        </p>
        <br>
        <div id="spa_concomitant_diseases" >գ. ուղեկցող հիվանդություն</div>
        <p>
        @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",
            StationaryDiagnosisEnum::concomitant_disease()) as $item)
                {{$item->disease_item->code_name ?? ""}}<br>
                {{$item->diagnosis_comment ?? ""}}<br><br>
                @empty

        @endforelse
        </p>
        <br><br>
        <div>Մահվան պատճառը</div>
        <p>{{$stationary->stationary_pathological_anatomical->cause_of_death ?? ""}}</p>
        <br><br>
        <div>Ախտաբան-Անատոմիական էպիկրիզ</div>
        <p>{{$stationary->stationary_pathological_anatomical->pathological_anatomical_epicrisis ?? ""}} </p>
        <br>
        @forelse($stationary->stationary_pathological_anatomical->attachments ?? [] as $attachment )
            <button  class="btn btn-outline-primary"><a href='{{$attachment->full_path ?? ""}}' target="_blank">View file</a> </button>
            @empty

        @endforelse
        <br><br>
        <div class="display-flex">
            <div>Դիահերձողի ախտաբանի ստորագրություն</div>
            <div class="bottom-line">{{$stationary->stationary_pathological_anatomical->user->full_name ?? ""}}</div>
        </div>
    </div>
</div>
