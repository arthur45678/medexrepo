<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/extract.css')}}">
    <title>ՔԱՂՎԱԾՔ</title>
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>
<div class="page-wrap">
    <div class="new-page">
        <div class="main-container">
            <br><br><br>
            <div class="float-right">
                <div class="display-flex">
                    <div>Ձևի կոդը ըստ ՕԿՈՒԴ-ի</div>
                    <span class="bottom-line">1</span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Հաստատութ. կոդը ըստ ՕԿՈՒՊ-ի</div>
                    <span class="bottom-line">1</span>
                </div>
            </div>
            <br><br><br><br><br>
            <table class="table" style="width: 100%;">
                <tr>
                    <th style="width: 341px;">Հայաստանի Հանրապետության <br> Առողջապահության Նախարարություն <br>
                        Ուռուցքաբանության Ազգային Կենտրոն
                    </th>
                    <th style="width: 237px;"></th>
                    <th>Բժշկական փաստաթղթեր <br> Ձև N 027-1/y</th>
                </tr>
            </table>
            <br>
            <br>
            <div class="text-center"><strong>ՔԱՂՎԱԾՔ</strong></div>
            <div class="text-center">չարորակ նորագոյացությամբ ստացիոնար հավանդի բժշկական քարտից <br> (լրացվում է բոլոր
                ստացիոնարների կողմից)
            </div>
            <br>
            <div class="display-flex">
                <div>Քաղվածք տված հաստատության հասցեն</div>
                <span class="bottom-line">Երևան, Ֆանարջյան փող., 76 շենք</span>
            </div>
            <br>
            <div>Հաստատության անվանումն ու հասցեն,ուր Քաղվածքն ուղարկվում է</div>
            <p>{{$extract['extract_sent']}}</p>
            <br>
            <div class="display-flex">
                <div>Չարորակ նորագոյացության ախտորոշումը դրվել է կյանքում առաջին անգամ</div>
                @if($extract['for_the_first_time']=='yes')
                    <span class="bottom-line">այո</span>
                @else
                    <span class="bottomՖ-line">ոչ</span>
                @endif
            </div>
            <br>
            <div class="display-flex">
                <div>Ազգանուն, անուն, հայրանուն</div>
                <span class="bottom-line">{{$patient->full_name}} {{$patient->p_name}}</span>
            </div>
            <br>
            <div class="display-flex">
                <div class="display-flex">
                    <div>Սեռը</div>
                    @if($patient->is_male==0)
                        <span class="bottom-line">Իգական</span>
                    @else
                        <span class="bottom-line">Արական</span>
                    @endif
                </div>
            </div>
            <br>
            <div class="display-flex">
                <div>Ազգություն</div>
                <span class="bottom-line">{{$patient->nationality}} </span>
            </div>
            <br>
            <div class="display-flex">
                <div>Ծննդյան ամսաթիվ</div>
                <span class="bottom-line">{{$patient->birth_date}}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Աշխատանքի վայրը</div>
                <span class='bottom-line'>{{$patient->workplace}}</span>
            </div>
            <br>

            <div class="display-flex">
                <div>Մասնագիտություն</div>
                <span class="bottom-line">{{$patient->profession}}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Հիվանդի հասցեն</div>
                <span class="bottom-line">{{$patient->residence_region}} {{$patient->street_house}}</span>
            </div>

            <br>
            <div class="display-flex">
                <div>Ստացիոնար ընդունվելու ամսաթիվ</div>
                <span
                    class="bottom-line">    {{\Illuminate\Support\Carbon::parse($stationaries->admission_date ?? "")->format('Y-m-d')}}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Դուրս գրման կամ մահվան ամսաթիվ</div>
                <span
                    class="bottom-line">{{\Illuminate\Support\Carbon::parse($stationaries->discharge_date ?? "")->format('Y-m-d')}}</span>
            </div>
            <br>
            <?php $strat_days = \Illuminate\Support\Carbon::parse($stationaries->admission_date ?? "");
            $end_days = \Illuminate\Support\Carbon::parse($stationaries->discharge_date ?? "");
            $Months = $strat_days->diff($end_days);?>
            <div class="display-flex">
                <div>Ստացիոնարում գտնվելու տևողությունը</div>

                @if($strat_days->diffInDays($end_days )>30)
                    <span class="bottom-line">{{$Months->m}} Ամիս {{$Months->d}} օր
                    </span>

                @else
                    <span class="bottom-line">{{$strat_days->diffInDays($end_days )}} օր
                    </span>

                @endif
            </div>
            <br>
            <div class="display-flex">
                <div>Հատուկ բուժում սկսելու ամսաթիվ</div>
                <span class="bottom-line">{{$extract['date']}}</span>
            </div>
            <br><br>

            <div>Վերջնական ախտորոշումը</div>
            <br>
            <div id="stationary_diagnosis_clinical">10.Կլինիկական ախտորոշումը</div>
            <p>
            @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
            \App\Enums\StationaryDiagnosisEnum::clinical()) as $item)

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
                    <br><br>
                    <div id="stationary_diagnosis_final_clinical">11.Վերջնական կլինիկական ախտորոշումը</div><br>
                    ա)վերջնական
                    <p>
                    @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
                    \App\Enums\StationaryDiagnosisEnum::final_clinical()) as $item)

                        @if( ($status = $item->approvementStatusBoolean()) !== null)
                            <div class="{{$status ?: 'waiting-for-approvement'}}">
                                {{$item->disease_item->code_name ?? ""}} <br>
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
                            <div id="stationary_diagnosis_disease_complication">բ)հիմնական հիվանդության բարդություն
                            </div>
                            <p>
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
                                    </p>
                                    <br>
                                    <div id="stationary_diagnosis_concomitant_disease">գ)ուղեկցող հիվանդություններ</div>
                                    <p>
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
                                            </p>
                                            <br>
                                            <div id="stationary_diagnosis_tuberculosis_complaint">դ)տուբերկուլյոզին
                                                բնորոշ գանգատներ
                                            </div>
                                            <p>
                                            @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
                                            \App\Enums\StationaryDiagnosisEnum::tuberculosis_complaint()) as $item)

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

                                            <span class="bottom-line"></span>


                                            <br><br>

                                            <div class="">Կլինիկական Խումբ</div>
                                            <br>
                                            <div>
                                            </div>
                                            <table class="table text-center">
                                                <tr>
                                                    <td><strong>Ամսաթիվ</strong></td>
                                                    <td><strong>Խումբ</strong></td>
                                                </tr>
                                                @forelse ($ambulator->patient->cancer_groups as $item)
                                                    <tr>
                                                        <td>{{date('d-m-Y', strtotime($item->pivot->created_at))}}</td>
                                                        <td>{{$item->name ?? ""}}</td>
                                                    </tr>
                                                @empty

                                                @endforelse

                                            </table>

                                            <br><br>

                                            <div>Ախտորոշումն հաստատված է</div>
                                            <?php $period_data = [
                                                "1" => "Մորֆոլոգիական",
                                                "2" => "Բջջաբանական",
                                                "3" => "Ռենտգենաբանական",
                                                "4" => "Էնդոսկոպիկ",
                                                "5" => "Ռադիոիզոտոպային մեթոդներով",
                                                "6" => "Միայն կլինկիորեն",
                                            ];
                                            ?>

                                            <br>
                                            <table class="table" border="2">
                                                <thead>
                                                <tr>
                                                    <th>Անվանումը</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($period as $periods)

                                                    <tr id="trashPeriodData{{$periods->id}}">
                                                        <td>{{$period_data[$periods->data] ?? ' '}}</td>

                                                    </tr>
                                                @endforeach


                                                </tbody>
                                            </table>


                                            <br><br>
                                            <div class="display-flex">
                                                <div>Ուռուցքի հյուսվածքաբանական կառուցվածքը</div>
                                                <span
                                                    class="bottom-line">{{$extract['tumor_histological_structure']}}</span>
                                            </div>
                                            <br>
                                            <div class="display-flex">
                                                <div>Բուժումը</div>
                                                @if($extract['treatment_type']=='radical')
                                                    <span class="bottom-line">Արմատական</span>
                                                @else
                                                    <span class="bottom-line">Ամոքիչ (պալիատաիվ)</span>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="new-page">

                                                <div>1.Միայն վիրահատական</div>
                                                <br>
                                                <table class="table text-center" border="2">
                                                    <tr>
                                                        <td>#</td>
                                                        <td><strong>Վիրահատության անվանումը</strong></td>
                                                        <td><strong>Ամսաթիվ, ժամ</strong></td>
                                                        <td><strong>Անզգայացման եղանակը</strong></td>
                                                        <td><strong>Բարդություններ</strong></td>
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

                                                <div>2.Միայն ճառագայթային</div>
                                                <br>
                                                <table class="table" border="2">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Անվանումը</th>
                                                        <th>Գրառման</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($treatment_c as $k=>$treatment_c_1)

                                                        <tr id="trashData{{$treatment_c_1->id}}">
                                                            <td>{{$k+1}}</td>
                                                            <td>{{$treatment_c_1->TreatmentList->name ?? ' '}}</td>

                                                            <td>{{$treatment_c_1->treatment_comments}}</td>

                                                        </tr>
                                                    @endforeach


                                                    </tbody>
                                                </table>
                                                <br><br>
                                                <div>ա/Դիստանցիոն գամմաթերապիա</div>
                                                <p>{{$extract['remote_gammotherapy']}}</p>
                                                <br>
                                                <div>բ/Ռենտգենոթերապիա</div>
                                                <p>{{$extract['rentgenoterapia']}}</p>
                                                <br>
                                                <div>գ/Արագ էլեկտրոններ</div>
                                                <p>{{$extract['fast_electrons']}}</p>
                                                <br>
                                                <div>դ/Համակցված 1.կոնտակտային և դիստանցիոն գամմաթերապիա</div>
                                                <p>{{$extract['gammotherapy']}}</p>
                                                <br>
                                                <div>ե/2.Կոնտակտային գամմաթերապիա և խորը ռենտգենոթերապիա</div>
                                                <p>{{$extract['contact_rentgenoterapia']}}</p>
                                                <br>
                                                <div>3.Զուգակցված բուժում վիրահատության ամսաթիվ և բնույթ,ճառագայթման
                                                    մեթոդիկա և տեսակը,կիրառման
                                                    հաջորդականությունը,ճառագայթման դոզան յուրաքանչյուրի համար առանձին
                                                    <?php $period_data_2 = [
                                                        "1" => "վիրահատական և գամմաթերապիա",
                                                        "2" => "վիրահատական և  ռենտգենոթերապիա",
                                                        "3" => "վիրահատական և ճառագայթային",
                                                        "4" => "վիրահատական և դեղորայքային",
                                                        "5" => "ճառագայթային և դեղորայքային մեթոդներով",

                                                    ];
                                                    ?>
                                                </div>
                                                <br>
                                                <table class="table" border="2">
                                                    <thead>
                                                    <tr>
                                                        <th>Անվանում</th>
                                                        <th>Գրառման</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($period2 as $periods2)

                                                        <tr id="trashPeriod2Data{{$periods2->id}}">
                                                            <td>{{$period_data_2[$periods2->data] ?? ' '}}</td>
                                                            <td>{{$periods2->comments}}</td>

                                                        </tr>
                                                    @endforeach


                                                    </tbody>
                                                </table>
                                                <br>
                                                <br>
                                                <div>4.Միայն քիմիաթերապևտիկ կամ հորմոնային</div>
                                                <p>{{$extract['only_chemotherapeutic_or_hormonal']}}</p>
                                                <br>
                                                <div>5.Համալիր բուժում</div>
                                                <br>
                                                <table class="table" border="2">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Անվանումը</th>
                                                        <th>Գրառման</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($treatment_c2 as $k=>$treatment_c2_1)

                                                        <tr id="trashData{{$treatment_c2_1->id}}">
                                                            <td>{{$k+1}}</td>
                                                            <td>{{$treatment_c2_1->TreatmentList->name ?? ' '}}</td>

                                                            <td>{{$treatment_c2_1->treatment_comments}}</td>

                                                        </tr>
                                                    @endforeach


                                                    </tbody>
                                                </table>
                                                <br>
                                                <div>6.Բուժման այլ եղանակներ</div>
                                                <br>
                                                <table class="table" border="2">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Անվանումը</th>
                                                        <th>Գրառման</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($treatment_c3 as $k=>$treatment_c3_1)

                                                        <tr id="trashData{{$treatment_c3_1->id}}">
                                                            <td>{{$k+1}}</td>
                                                            <td>{{$treatment_c3_1->TreatmentList->name ?? ' '}}</td>

                                                            <td>{{$treatment_c3_1->treatment_comments}}</td>
                                                        </tr>
                                                    @endforeach


                                                    </tbody>
                                                </table>
                                                <br>

                                                <div class="display-flex">
                                                    <div>Ամսաթիվ</div>
                                                    <span class="bottom-line">{{$extract['admission_date']}}</span>
                                                </div>
                                                <br>
                                                <div class="display-flex">
                                                    <div>Բուժող բժիշկ՝</div>
                                                    <span
                                                        class="bottom-line">{{$extract->attendingdoctor->full_name ?? ' '}}</span>
                                                </div>

                                            </div>
                                            <br>
                                            <br>
                                            <br>
        </div>
    </div>
</div>
</body>
</html>
