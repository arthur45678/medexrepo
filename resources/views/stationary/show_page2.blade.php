<?php
use App\Enums\StationaryDiagnosisEnum;
use App\Enums\StationaryMedicineSideEffectEnum as MedSideEffect;
use App\Enums\StationarySurgeryEnum;
?>
<div class="new-page">
    <div class="header">
        <table>
            <tr>
                <td>
                    Ձևի կոդը ըստ ՕԿՈՒԴ-ի
                    <span></span>
                </td>
            </tr>
            <tr>
                <td>
                    Հիմնարկության կոդը ըստ ՕԿՊՕ-ի
                    <span></span>
                </td>
            </tr>
        </table>
    </div>
    <div class="flex-container">
        <div class="flex-item1">
            Առողջապահության նախարարություն
            <p></p>
            Բ․Ա․ Ֆանարջյանի անվան <br>
            ՈՒռուցքաբանության ազգային կենտրոն
        </div>
        <div class="flex-item2"></div>
        <div class="flex-item3">
            <div class="text-center">ԲԺՇԿԱԿԱՆ ՓԱՍՏԱԹՂԹԵՐ <br>
                Ձև N 123/2020 հաստատված ԽՍՀՄ ԱՆ կողմից <br>
                01․02․80 N 1020
            </div>
        </div>
    </div>
    <br><br>

    <div class="text-center">
        <strong>Ստացիոնար հիվանդի</strong>
        <h3>ԲԺՇԿԱԿԱՆ ՔԱՐՏ N {{$stationary->number ?? ""}}</h3>
    </div>
    <div class="float-left">Ընդունման ամսաթիվը և ժամը</div>
    <div class="bottom-line float-left">{{$stationary->admission_date ?? ""}}</div>
    <div class="float-left">&nbsp;&nbsp;Հասակը</div>
    <div class="bottom-line float-left">{{$stationary->height ?? ""}} սմ</div>
    <br><br>
    <div class="float-left">Դուրս գրման ամսաթիվը և ժամը</div>
    <div class="bottom-line float-left">{{$stationary->discharge_date ?? ""}}</div>
    <div class="float-left">&nbsp;&nbsp;Քաշը</div>
    <div class="bottom-line float-left">{{$stationary->weight ?? ""}} կգ</div>
    <div class="float-left">&nbsp;&nbsp;ՄԶԻ</div>
    <div class="bottom-line float-left">{{$stationary->mzi() ?? ""}} կգ</div>
    <br><br>
    <div class="float-left">Բաժանմունք</div>
    <div class="bottom-line float-left">{{$stationary->department->name ?? ""}}</div>
    <div class="float-left">&nbsp;&nbsp;հիվանդասենյակ N </div>
    <div class="bottom-line float-left">{{$stationary->chamber ?? ""}} ({{$stationary->is_paid ? 'Վճարովի է' : 'Անվճար է' ?? ""}})</div>
    <br><br>
    <div class="float-left">Մահճակալ</div>
    <div class="bottom-line float-left">{{$stationary->bed ?? ""}}</div>
    <br><br>
    <div class="float-left">Օրերի քանակը</div>
    <div class="bottom-line float-left">{{$stationary->days_qty ?? ""}}</div>
    <br><br>
    <div class="float-left">Տեղափոխման ձևը ՝</div>
    <div class="bottom-line float-left">
        {{$stationary->by_wheelchair ? ' հիվանդասայլակով' : 'կարող է քայլել' ?? ""}}
    </div>
    <br><br>
    <div id="stationary_medicine_side_effect_intolerance">Դեղանյութերի կողմնակի ազդեցությունը(անտանելիությունը)</div>
    <p>
        @forelse ($stationary->stationary_medicine_side_effects->where('type', MedSideEffect::intolerance()) as $item)

            @if( ($status = $item->approvementStatusBoolean()) !== null)
                <div class="{{$status ?: 'waiting-for-approvement'}}">
                    {{$item->medicine_item->code_name ?? ""}} <br>
                    {{$item->medicine_comment ?? ""}} <br><br>
                    <span class="print-hide">{{$item->approvementStatus()}}</span>
                </div>
            @else
                {{$item->medicine_item->code_name ?? ""}} <br>
                {{$item->medicine_comment ?? ""}} <br> <br>
            @endif

            @empty

        @endforelse
    </p>
    <br><br>
    <div class="float-left">1․Ազգանուն, Անուն, Հայրանուն</div>
    <div class="bottom-line float-left">{{$patient->all_names ?? ""}}</div>
    <div class="float-left">&nbsp;&nbsp;2․Սեռը</div>
    <div class="bottom-line float-left">{{$patient->sex ?? ""}}</div>
    <br><br>
    <div class="float-left">3.Տարիք</div>
    <div class="bottom-line float-left">{{$stationary->age ?? ""}}
        @if ($stationary->age_type == 'year' ?? "")
            տարեկան
        @elseif($stationary->age_type == 'mounth' ?? "")
            ամսեկան
        @else
            օրեկան
        @endif
    </div>
    <div class="float-left"></div>&nbsp;&nbsp;(լրիվ տարիք, մինչև 1 տ․ երեխաների մոտ ամիսներ, միչև 1 տ․ երեխաների մոտ օրեր)
    <div class="float-left"></div>
    <br><br>
    <div>4.Մշտական բնակավայրը ՝ քաղաք, գյուղ | Հեռախոսահամար </div>
    <p>{{$patient->residence_region ?? ""}}, {{$patient->town_village ?? ""}}, {{$patient->m_phone ?? ""}}</p>
    <br>
    <div>5.Աշխատավայրը, մասնագիտությունը կամ պաշտոնը</div>
    <p>{{$patient->workplace ?? ""}} | {{$patient->profession ?? ""}}</p>
    <br>
    <div class="float-left">6.Ում կողմից է ուղարկված հիվանդը</div>
    <div class="bottom-line float-left">{{optional($stationary->clinic)->name}}</div><br><br>
    <div>Մալարիայի էնդեմիկ գոտում -
        <?php
            if ($stationary->malaria_endemic_zone == '1') {
            echo "Եղել է";
            } elseif ($stationary->malaria_endemic_zone == '0') {
            echo "Չի եղել";
            } elseif ($stationary->malaria_endemic_zone == null){
            echo "";
            } 
        ?>
    </div>
    <br>
    <div>7.Ստացիոնար է տեղափոխվել անհետաձգելի ցուցումներով ՝
        {{$stationary->is_urgent ? '(այո)' : '(ոչ)' ?? ""}}
    </div>
    <br>
    <div>7.1 Վնասվացք ստանալուց ՝
        <span class="bottom-line"> {{$stationary->hours_later ?? ""}}</span>&nbsp;&nbsp; ժամ անց,
    </div>
    <br>
    <div>7.2 Հոսպիտալացվել է պլանաըին կարգով ՝
        <span class="bottom-line"> 
           {{$stationary->is_planned ? '(այո)' : '(ոչ)' ?? "" }}
             
        </span>
    </div>
      
    </div>
    <br><br>
    <div id="stationary_diagnosis_referring_institution">8.Ուղեգրող հաստատության ախտորոշումը</div>
    <p>
        @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",StationaryDiagnosisEnum::referring_institution()) as $item)

            @if( ($status = $item->approvementStatusBoolean()) !== null)
                <div class="{{$status ?: 'waiting-for-approvement'}}">
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                    <span class="print-hide">{{$item->approvementStatus()}}</span>
                </div>
            @else
                {{$item->disease_item->code_name  ?? ""}} <br>
                {{$item->diagnosis_comment ?? ""}} <br> <br>
            @endif

            @empty

        @endforelse
    </p>
    <br>
    <div id="stationary_diagnosis_admission">9.Ախտորոշումն ընդունվելիս</div>
    <p>
        @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",StationaryDiagnosisEnum::admission()) as $item)

            @if( ($status = $item->approvementStatusBoolean()) !== null)
                <div class="{{$status ?: 'waiting-for-approvement'}}">
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                    <span class="print-hide">{{$item->approvementStatus()}}</span>
                </div>
            @else
                {{$item->disease_item->code_name  ?? ""}} <br>
                {{$item->diagnosis_comment ?? ""}} <br> <br>
            @endif

            @empty

        @endforelse
    </p>
    <br>
    <div id="stationary_diagnosis_clinical">10.Կլինիկական ախտորոշումը</div>
    <p>
        @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",
        StationaryDiagnosisEnum::clinical()) as $item)

            @if( ($status = $item->approvementStatusBoolean()) !== null)
                <div class="{{$status ?: 'waiting-for-approvement'}}">
                    {{$item->diagnosis_date ?? ""}}<br>
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}}<br><br>
                    <span class="print-hide">{{$item->approvementStatus()}}</span>
                </div>
            @else
                {{$item->diagnosis_date ?? ""}}<br>
                {{$item->disease_item->code_name ?? ""}} <br>
                {{$item->diagnosis_comment ?? ""}}<br><br>
            @endif

            @empty

        @endforelse
    </p>
    <br>
    <div id="stationary_diagnosis_final_clinical">11.Վերջնական կլինիկական ախտորոշումը</div><br>
    ա)վերջնական
    <p>
        @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",
        StationaryDiagnosisEnum::final_clinical()) as $item)

            @if( ($status = $item->approvementStatusBoolean()) !== null)
                <div class="{{$status ?: 'waiting-for-approvement'}}">
                    {{$item->disease_item->code_name ?? ""}}  <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                    <span class="print-hide">{{$item->approvementStatus()}}</span>
                </div>
            @else
                {{$item->disease_item->code_name ?? ""}}  <br>
                {{$item->diagnosis_comment ?? ""}} <br><br>
            @endif

            @empty

        @endforelse
    </p>
    <br>
    <div id="stationary_diagnosis_disease_complication">բ)հիմնական հիվանդության բարդություն</div>
    <p>
        @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",
        StationaryDiagnosisEnum::disease_complication()) as $item)

            @if( ($status = $item->approvementStatusBoolean()) !== null)
                <div class="{{$status ?: 'waiting-for-approvement'}}">
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                    <span class="print-hide">{{$item->approvementStatus()}}</span>
                </div>
            @else
                {{$item->disease_item->code_name ?? ""}} <br>
                {{$item->diagnosis_comment ?? ""}} <br><br>
            @endif

            @empty

        @endforelse
    </p>
    <br>
    <div id="stationary_diagnosis_concomitant_disease">գ)ուղեկցող հիվանդություններ</div>
        <p>
            @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",
            StationaryDiagnosisEnum::concomitant_disease()) as $item)

                @if( ($status = $item->approvementStatusBoolean()) !== null)
                    <div class="{{$status ?: 'waiting-for-approvement'}}">
                        {{$item->disease_item->code_name ?? ""}} <br>
                        {{$item->diagnosis_comment ?? ""}} <br><br>
                        <span class="print-hide">{{$item->approvementStatus()}}</span>
                    </div>
                @else
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                @endif

                @empty

            @endforelse
        </p>
        <br>
        <div id="stationary_diagnosis_tuberculosis_complaint">դ)տուբերկուլյոզին բնորոշ գանգատներ</div>
        <p>
            @forelse ($stationary->stationary_diagnoses->where("diagnosis_type",
            StationaryDiagnosisEnum::tuberculosis_complaint()) as $item)

                @if( ($status = $item->approvementStatusBoolean()) !== null)
                    <div class="{{$status ?: 'waiting-for-approvement'}}">
                        {{$item->disease_item->code_name ?? ""}} <br>
                        {{$item->diagnosis_comment ?? ""}} <br><br>
                        <span class="print-hide">{{$item->approvementStatus()}}</span>
                    </div>
                @else
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                @endif

                @empty

            @endforelse
        </p>
        <br>
        <div class="float-left">12.Տվյալ տարում տվյալ հիվանդության կապակցությամբ հոսպիտալացվել է</div>
        <div class="bottom-line float-left">{{$stationary->times_hospitalized ?? ""}}</div> -անգամ

        <br><br>
        <div id="stationary_surgeries">13․Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ</div>
        <br><br>
        <table class="text-center surgery">
            <tr>
                <td>#</td>
                <td>Վիրահատության <br> անվանումը</td>
                <td>Ամսաթիվ,<br> ժամ</td>
                <td>Անզգայացման<br> եղանակը</td>
                <td>Բարդություններ</td>
            </tr>
                @forelse($stationary->stationary_surgeries->where('type', StationarySurgeryEnum::stationary()) as $item)
                    <tr>
                        <td>{{$item->stationary_id ?? ""}}</td>
                        <td>{{$item->surgery->name ?? ""}}</td>
                        <td>{{$item->surgery_date ?? ""}}</td>
                        <td>{{$item->anesthesia->name ?? ""}}</td>
                        <td>{{$item->complications ?? ""}}</td>
                    </tr>
                    @empty

                @endforelse
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br>

        <div class="float-left">Վիրահատել է՝</div>
        <div class="bottom-line float-left">
            @if($last_surgery = $stationary->stationary_surgeries->where('type', StationarySurgeryEnum::stationary())->last())
                {{$last_surgery->user->full_name ?? ""}}
            @endif
        </div>
        <br><br><br>

        <div id="stationary_treatments" >14․Բուժման այլ տեսակներ</div>
        <p>
            @forelse ($stationary->stationary_treatments as $item)

                @if( ($status = $item->approvementStatusBoolean()) !== null)
                    <div class="{{$status ?: 'waiting-for-approvement'}}">
                        {{$item->treatment_item->name ?? ""}} - {{ $item->treatment_comment ?? ""}} <br>
                        <span class="print-hide">{{$item->approvementStatus()}}</span>
                    </div>
                @else
                    {{$item->treatment_item->name ?? ""}} - {{ $item->treatment_comment ?? ""}} <br>
                @endif

                @empty

            @endforelse
        </p>
        <div>Չարորակ նորագոյություններով հիվանդների համար․ -
            @forelse($stationary->tumor_treatments as $item)
                <span class="bottom-line" >{{$item->name ?? ""}}</span>
                @empty

            @endforelse
        </div>
        <br><br>
        <div id="stationary_disability_certificates" >15.Նշումներ անաշխատունակության թերթիկ տրման մասին</div>
        <br>
            @forelse ($stationary->stationary_disability_certificates as $item)

                @if( ($status = $item->approvementStatusBoolean()) !== null)
                <div class="{{$status ?: 'waiting-for-approvement'}}">
                    <div class="float-left">N {{$item->number ?? ""}}</div>
                    <div class="bottom-line float-left ">{{$item->from ?? ""}}</div>
                    <div class="float-left"> -ից, միչև</div>
                    <div class="bottom-line float-left ">{{$item->to ?? ""}}</div>
                    <span class="print-hide">{{$item->approvementStatus()}}</span>
                </div>
                @else
                    <div class="float-left">N {{$item->number ?? ""}}</div>
                    <div class="bottom-line float-left ">{{$item->from ?? ""}}</div>
                    <div class="float-left"> -ից, միչև</div>
                    <div class="bottom-line float-left ">{{$item->to ?? ""}}</div>
                @endif



                @empty

            @endforelse
        <br><br><br>
        <div class="float-left">16.Հիվանդության ելքը՝ դուրս է գրվել</div>
        <div class="bottom-line float-left ">
            @php
                $stationary_disease_outcomes = $stationary->stationary_disease_outcomes;
                $outcome = !is_null($stationary_disease_outcomes) ? $stationary->stationary_disease_outcomes->outcome->getValue() : "";
                $outcome_lng = $outcome ? __("enums.stationary_disease_outcome_enum.{$outcome}") : "";
            @endphp
            {{-- - {{__("enums.stationary_disease_outcome_enum.{$stationary->stationary_disease_outcomes->outcome->getValue()}") ?? ""}} --}}
            {{$outcome_lng}}
        </div>
        <br><br>
        <div>Տեղափոխվել է այլ հաստատություն</div>
        <br>
        <div class="float-left">Բժշկական հաստատության անվանումը</div>
        <div class="bottom-line float-left">
            {{$stationary->clinic->name ?? ""}}
        </div>
        <br>
        <br>
        <br>
        <div>17.Անաշխատունակությունը վերականգնված է՝</div>
        <p>{{$stationary->work_efficiency_comment ?? ""}}</p>
        <br>
        <div id="stationary_expertise_conclusions" >18․Փորձաքնության ընդունվածների համար, եզրակացությունը</div>
        <p>
            @forelse ($stationary->stationary_expertise_conclusions as $item)

                    @if( ($status = $item->approvementStatusBoolean()) !== null)
                    <div class="{{$status ?: 'waiting-for-approvement'}}">
                        {{$item->conclusion ?? ""}}
                        <span class="print-hide">{{$item->approvementStatus()}}</span>
                    </div>
                    @else
                        {{$item->conclusion ?? ""}}
                    @endif

                @empty

            @endforelse
        </p>
        <br>
        <div id="stationary_histological_examinations" >19․Հյուսվածաբանական հետազոտության արդյունքը, ամսաթիվ, համար #</div>
        <p>
            @forelse ($stationary->stationary_histological_examinations as $item)

                @if( ($status = $item->approvementStatusBoolean()) !== null)
                    <div class="{{$status ?: 'waiting-for-approvement'}}">
                        {{$item->examination_date ?? ""}} -
                        {{$item->examination ?? ""}} <br>
                        <span class="print-hide">{{$item->approvementStatus()}}</span>
                    </div>
                @else
                    {{$item->examination_date ?? ""}} -
                    {{$item->examination ?? ""}} <br>
                @endif

                @empty

            @endforelse
        </p>
        <br><br>
        <div class="float-left">Բուժող բժիշկ՝</div>
        <div class="bottom-line float-left">{{$item->user->full_name ?? ""}}</div>
        <br><br><br>
        <div class="float-left">Բաժանմունքի վարիչ՝</div>
        <div class="bottom-line float-left">{{$stationary->department_head->full_name ?? ""}}</div>
        <br><br><br><br><br>
