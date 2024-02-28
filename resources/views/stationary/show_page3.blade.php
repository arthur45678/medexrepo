<?php
use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryMedicineSideEffectEnum as MedSideEffect;
use App\Enums\StationarySurgeryEnum;

$spe = $stationary->stationary_primary_examination;
$spe_approvementStatusBoolean = !is_null($spe) ? $spe->approvementStatusBoolean() : "";
$spe_classname = $spe_approvementStatusBoolean === false ? 'waiting-for-approvement' : "" ;
// $classname = $stationary->stationary_primary_examination->approvementStatusBoolean() === false ? 'waiting-for-approvement' : "" ;

$spe_approvementStatus = !is_null($spe) ? $spe->approvementStatus() : "";
?>
<div class="new-page">

    <div class="{{$spe_classname}}">
        <div id="primary-examination" class="text-center"> <strong>ԱՌԱՋՆԱՅԻՆ ԶՆՆՈՒՄ</strong></div>
    </div>
    <br>
    {{-- <span class="print-hide">{{$stationary->stationary_primary_examination->approvementStatus()}}</span> --}}
    <span class="print-hide">{{$spe_approvementStatus}}</span>
    <br><br>
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div class="bottom-line">{{$stationary->stationary_primary_examination->examination_date ?? ""}}</div>
            </div>

            <br><br>
            <div>Գանգատները</div>
            <p>
                {{$stationary->stationary_primary_examination->complaints ?? ""}}
            </p>
            <br>
            <div><u>Anamnesis morbi</u> </div>
            <p>
                {{$stationary->stationary_primary_examination->anamnesis_morbi ?? ""}}
            </p>
            <br>
            <div><u>Anamnesis vitae</u> </div>
            <br>
            <div>Աճը և զարգացումը</div>
            <p>
                {{$stationary->stationary_primary_examination->growth_and_development ?? ""}}
            </p>
            <br>
            <div id="stationary_diagnosis_previous_disease">Նախկինում տարած ուրիշ հիվանդություններ</div>
            <p>
                @forelse ($stationary->stationary_diagnoses->where('diagnosis_type', StationaryDiagnosisEnum::previous_disease()) as $item)
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                    @empty

                @endforelse
            </p>
            <br><br>
            <div id="surgeries-primary-examination">Վիրահատություններ</div>
            <p>
                @forelse ($stationary->stationary_surgeries->where('type', StationarySurgeryEnum::stationary_primary_examination()) as $item)
                    {{$item->surgery->code_name ?? ""}}<br>
                    {{$item->complications ?? ""}}<br><br>
                    @empty

                @endforelse
            </p>
            <br><br>
            <div id="stationary_medicine_side_effect_allergy">Դեղանյութերի նկատմամբ ալերգիկ երևույթներ</div>
            <p>
                @forelse ($stationary->stationary_medicine_side_effects->where('type', MedSideEffect::allergy()) as $item)
                    {{$item->medicine_item->code_name ?? ""}}<br>
                    {{$item->medicine_comment ?? ""}}<br><br>
                    @empty

                @endforelse
            </p>
            <br><br>
            <div id="stationary-harmfuls">Վնասակար սովորություններ</div>
            <p>
                @forelse ($stationary->stationary_harmfuls as $item)
                    {{$item->harmful->name ?? ""}} <br>
                    {{$item->harmful_comment ?? ""}} <br><br>
                    @empty

                @endforelse
            </p>
            <br><br>
            <div>Ժառանգականությունը ծանրաբեռնված</div>
            <p>{{$stationary->stationary_primary_examination->inheritance ?? ""}}</p>
            <br>
            <div><u>Սեռական անամանեզ</u> </div>
            <p>{{$stationary->stationary_primary_examination->sextual_history ?? ""}}</p>
            <br><br>
            <div>Կանանց մոտ՝</div>
            <br>
            <div class="float-left">Menarche </div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->menarche_age ?? ""}}</div>
            <div class="float-left"> տ․, ցիկլը </div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->cycle_from ?? ""}}-{{$stationary->stationary_primary_examination->cycle_to ?? ""}}</div> տիպի
            <br><br>
            <p></p>
            <br>
            <div class="float-left">Վերջին mensis</div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->last_mensis ?? ""}}</div>
            <div class="float-left">, menopausa</div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->menopausa_age ?? ""}}</div> տ.
            <br><br>
            <div class="float-left">Հղիությունների թիվը</div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->number_of_pregnancies ?? ""}}</div>
            <div class="float-left">, ծննդաբերություններ</div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->number_of_births ?? ""}}</div>
            <br><br>
            <div class="float-left">Արհեստական ընդհատումներ</div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->number_of_interruptions ?? ""}}</div>
            <div class="float-left">, վիժումներ</div>
            <div class="bottom-line float-left">{{$stationary->stationary_primary_examination->number_of_abortions ?? ""}}</div>
            <br><br><br>
            <div>
                Կրծքով կերակրելը {{optional($stationary->stationary_primary_examination)->breast_feeding ?  '(այո)' : '(ոչ)' ?? ""}}</div>
            <p>
                {{$stationary->stationary_primary_examination->breast_feeding_comment ?? ""}}
            </p>
            <br>
            <div>Հորմոնային դեղամիջոցների ընդունում {{optional($stationary->stationary_primary_examination)->taking_hormonal_drugs ?  '(այո)' : '(ոչ)' ?? ""}}</div>
            <p>
                {{$stationary->stationary_primary_examination->taking_hormonal_drugs_comment ?? ""}}
            </p>
            <br>
            <br>

    {{-- <div> --}}
</div>
