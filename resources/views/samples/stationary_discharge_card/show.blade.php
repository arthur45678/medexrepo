<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/stationary_discharge_card.css')}}">
    <title>Ստացիոնարից դուրս գրվածի վիճակագրական քարտ</title>
</head>
<body>
<div class="page-wrap">
    <div class="new-page">
        <div class="main-container">
            <br>
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
                    Հայաստանի Հանրապետության<br>
                    Առողջապահության Նախարարություն<br>
                    ՈՒռուցքաբանության ազգային կենտրոն
                </div>
                <div class="flex-item2"></div>
                <div class="flex-item3">
                    <div class="text-center">ԲԺՇԿԱԿԱՆ ՓԱՍՏԱԹՂԹԵՐ <br>
                        Ձև N 066/V
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center">ՍՏԱՑԻՈՆԱՐԻՑ ԴՈՒՐՍ ԳՐՎԱԾի ՎԻՃԱԿԱԳՐԱԿԱՆ ՔԱՐՏ</div>
            <br><br>

            <div class="display-flex">
                <div>1․ Ազգանուն, Անուն, Հայրանուն</div>
                <div class="bottom-line">{{$patient->all_names}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Սեռը</div>
                <div class="bottom-line">
                    @if($patient->is_male==0)
                        <ins class="ml-4">Իգական</ins>
                    @else
                        <ins class="ml-4">Արական</ins>
                    @endif
                </div>
            </div>
            <br>
            <div class="display-flex">
                <div>Ծննդյան ամսաթիվ</div>
                <div class="bottom-line">{{$patient->birth_date}}</div>
            </div>
            <br><br>
            <div class="display-flex">
                <div>2․ Մշտական հասցեն</div>
                <div class="bottom-line">{{$patient->town_village}}</div>
            </div>
            <br>
            <div>Բնակիչ է ՝ <span>{{$patient->residence_region}} </span></div>
            <br>
            <br>
            <div>3․ Ում կողմից է ուղարկված հիվանդը</div>
            <p>{{$stationaries->clinic->name ?? ' '}}</p>
            <br>
            <div class="display-flex">
                <div>Բաժանմունքը</div>
                <div class="bottom-line">{{$departmentauth->name}}</div>
            </div>
            <br>
            <div>Մահճակալի պռոֆիլը</div>
            <p>{{$descharge->bed_profiles}}</p>
            <br>
            <div class="display-flex">
                <div>4․ Ստացիոնար է ընդունվել անհետաձգելի ցուցումով է</div>
                <div class="bottom-line">{{$stationaries->is_urgent ? 'այո' : 'ոչ' ?? ""}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>5․ Հիվանդության սկզից (վնասվածք ստանալուց հետո), քանի ժամ անց</div>
                <div class="bottom-line">
                    {{$stationaries->hours_later ?? ""}} ժամ անց

                </div>
            </div>
            <br>
            <div class="display-flex">
                <div>6․ Ստացիոնար ընդունվելու ամսաթիվը, ժամը</div>
                <div
                    class="bottom-line">{{\Illuminate\Support\Carbon::parse($descharge->research_date)->format('Y-m-d')}}
                    <span>  {{$stationaries->admission_date ?? ""}}</span></div>
            </div>
            <br>
            <div class="display-flex">
                <div>7․ Հիվանդության Ելքը</div>
                <div class="bottom-line">
                    @php
                        $stationary_disease_outcomes = $stationaries->stationary_disease_outcomes;
                        $outcome = !is_null($stationary_disease_outcomes) ? $stationaries->stationary_disease_outcomes->outcome->getValue() : "";
                        $outcome_lng = $outcome ? __("enums.stationary_disease_outcome_enum.{$outcome}") : "";
                    @endphp
                    - {{__("enums.stationary_disease_outcome_enum.{$stationaries->stationary_disease_outcomes->outcome->getValue()}") ?? ""}}
                    {{$outcome_lng}}

                </div>
            </div>
            <br>
            <div class="display-flex">
                <div>7ա․ Դուրս գրման,(մահվան)ամսաթիվը, ժամը</div>
                <div
                    class="bottom-line">{{\Illuminate\Support\Carbon::parse($descharge->date_discharge_or_death)->format('Y-m-d')}}
                    <span>   {{$stationaries->discharge_date ?? ""}}</span>
                </div>
            </div>
            <br>
            <div>7բ․ Անցկացրել է (օր)</div>
            <p>{{$stationaries->bed ?? ""}}-{{$stationaries->days_qty ?? ""}}</p>
            <br>
            <div>8․ Ուղարկած հաստաության ախտորոշումը</div>
            <p>  @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",\App\Enums\StationaryDiagnosisEnum::referring_institution()) as $item)

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
            <div class="display-flex">
                <div>9․ Տվյալ տարում տվյալ հիվանդության կապակցությամբ հոսպիտալացվել է ՝</div>
                <div class="bottom-line">
                    @if($descharge->hospitalized=='first_time')
                        Առաջին անգամ
                    @else
                        կրկնակի
                    @endif

                </div>
            </div>
            <br>
            <br>
            <div>10․ Ուղարկած հաստաության ախտորոշումը</div>
            <br>
            <table class="text-center">
                <tr>
                    <td></td>
                    <td>Հիմնական</td>
                    <td>Բարդություններ</td>
                    <td>Ուղեկցվող հիվանդություններ</td>

                </tr>
                <tr>
                    <td>Վերջնական կլինիկական</td>

                    <td>

                        @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
                        \App\Enums\StationaryDiagnosisEnum::final_clinical()) as $item)

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

                    </td>

                    <td>


        @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
        \App\Enums\StationaryDiagnosisEnum::disease_complication()) as $item)

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

                </td>
                    <td>գ)ուղեկցող հիվանդություններ</div>

    @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
    \App\Enums\StationaryDiagnosisEnum::concomitant_disease()) as $item)

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
          </td>

                </tr>
                <tr>
                    <td>Ախտաբանական անատոմիական</td>

                    <td>      @forelse($stationaries->stationary_diagnoses->where("diagnosis_type",  \App\Enums\StationaryDiagnosisEnum::primary_disease()) as $item)
                            {{$item->disease_item->code_name ?? ""}}  <br>
                            {{$item->diagnosis_comment ?? ""}} <br><br>
                        @empty

                        @endforelse
                    </td>
                    <td>
                        @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
       \App\Enums\StationaryDiagnosisEnum::disease_complication()) as $item)
                            {{$item->disease_item->code_name ?? ""}} <br>
                            {{$item->diagnosis_comment ?? ""}} <br><br>
                        @empty

                        @endforelse
                    </td>
                    <td>
                        @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
         \App\Enums\StationaryDiagnosisEnum::concomitant_disease()) as $item)
                            {{$item->disease_item->code_name ?? ""}}<br>
                            {{$item->diagnosis_comment ?? ""}}<br><br>
                        @empty

                        @endforelse
                    </td>
                </tr>
            </table>
            <br>
            <div>11․Մահվան դեպքում (նշել պատճառը)</div>
            <br>
            <div>1․ ա) Մահվան անմիջական պատճառը (հիվանդության կամ հիմնական հիվանդության բորդություն)</div>
            <p>{{$descharge->died_a_comment}}</p>
            <br>
            <div>բ) Մահվան անմիջական պատճառը (հիվանդության կամ հիմնական հիվանդության բորդություն)</div>
            <p>{{$descharge->died_b_comment}}</p>
            <br>
            <div>գ)Հիմնական հիվանդություն</div>
            <p>          @forelse($stationaries->stationary_diagnoses->where("diagnosis_type", \App\Enums\StationaryDiagnosisEnum::primary_disease()) as $item)

                @if( ($status = $item->approvementStatusBoolean()) !== null)
                    <div class="{{$status ?: 'waiting-for-approvement'}}">
                        {{$item->disease_item->code_name ?? ""}}  <br>
                        {{$item->diagnosis_comment ?? ""}} <br><br>
                        <span class="print-hide">{{$item->approvementStatus()}}</span>
                    </div>
                @else
                    {{$item->disease_item->code_name ?? ""}} <br>
                    {{$item->diagnosis_comment ?? ""}} <br><br>
                    @endif

                    @empty

                    @endforelse</p>
            <br>
            <div>2․ Ուրիշ կարևոր հիվանդություններ, որոնք նպաստել են մահացու ելքին, բայց կապված չեն մահվան անմիջական
                պատճառ հանդիսացած հիվանդության հետ
            </div>
            <p>{{$descharge->died_d_comment}}</p>
            <br>
            <br>
            <div>12․Վիրահատություններ</div>
            <br>
            <table class="text-center surgery" border="1">
                <tr>
                    <td>#</td>
                    <td>Վիրահատության <br> անվանումը</td>
                    <td>Ամսաթիվ,<br> ժամ</td>
                    <td>Անզգայացման<br> եղանակը</td>
                    <td>Բարդություններ</td>
                </tr>
                @forelse($stationaries->stationary_surgeries->where('type', \App\Enums\StationarySurgeryEnum::stationary()) as $item)
                    <tr>
                        <td>{{$item->stationary_id ?? ""}}</td>
                        <td>{{$item->surgery->name ?? ""}}</td>
                        <td>{{$item->surgery_date ?? ""}}</td>
                        <td>{{$item->anesthesia->name ?? ""}}</td>
                        <td>{{$item->complications ?? ""}}</td>
                    </tr>
                @empty

                @endforelse

            </table>
            <br>
            <div>13․Վիրահատություններ</div>
            <br>
            <div class="display-flex">
                <div>RW հետազոտության ամսաթիվը, արդյունքը</div>
                <div class="bottom-line">{{\Illuminate\Support\Carbon::parse($descharge->date)->format('Y-m-d')}}</div>
            </div>
            <p>{{$descharge->result}}</p>
            <br>
            <div class="display-flex">
                <div>Հայրենական պատերազմի հաշմանդամ</div>
                <div class="bottom-line">
                    @if($descharge->armenia_war_invalid=='yes')
                        այո
                    @else
                        ոչ
                    @endif
                </div>
            </div>
            <br>
            <div class="display-flex">
                <div>Արցախյան պատերազմի հաշմանդամ</div>
                <div class="bottom-line">
                    @if($descharge->arcax_war_invalid=='yes')
                        այո
                    @else
                        ոչ
                    @endif
                </div>
            </div>
            <br>
            <div class="display-flex">
                <div>Ստորագրություն</div>
                <div class="bottom-line">{{$descharge->Doctor->name ?? ' '}}</div>
            </div>

            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
</div>
</body>
</html>
