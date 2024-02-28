<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/medical_care_accounting1.css')}}">
    <title>Բժշ․ օգնության ծավալների հաշվառման ձև 0001</title>
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endisset
</head>
<body>
<div class="page-wrap">
    <div class="new-page">
        <div class="main-container">
            <br><br>

            <div class="display-flex">
                <div class="text-center">
                    ՀԻՎԱՆԴԱՆՈՑԱՅԻՆ ԲԺՇԿԱԿԱՆ ՕԳՆՈՒԹՅԱՆ ԵՎ ՍՊԱՍԱՐԿՄԱՆ <br>
                    ԾԱՎԱԼՆԵՐԻ ՀԱՇՎԱՌՄԱՆ ՁԵՎ 0001
                </div>
                <div class="margin-left text-center">
                    <table>
                        <tr>
                            <td width="100%" height="50px">
                                Հաստատված ՀՀ ԱՆ 2011թ․-ի հրամանով
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <br><br>

            <div class="display-flex">
                <div><strong>Դեպքի Կարգավիճակ</strong></div>
                <div class="bottom-line">
                    @if($medicalCareAccounting->case_status=='free')
                        Պետ Պատվեր
                    @else
                        Պետ պատվեր (վճարովի)
                    @endif
                </div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>1.</strong> Ուղեգիր համար N</div>
                <div class="bottom-line">{{$medicalCareAccounting['tickets_N']}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>2.</strong> Ուղեգրող բժշկական հաստատության անվանումը, կոդը</div>
                <div class="bottom-line">{{$medicalCareAccounting->Clinic_Name->name ?? ' '}}, {{$medicalCareAccounting->Clinic_Name->code ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>3.</strong> Ուղեգրման ամսաթիվը </div>
                <div class="bottom-line">{{\Illuminate\Support\Carbon::parse($medicalCareAccounting->date)->format('Y-m-d')}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>4.</strong> c  </div>
                <div class="bottom-line">{{$medicalCareAccounting->c ?? ' '}}</div>
            </div>

            <br>
            {{--$stationaries--}}
            <div class="display-flex">
                <div><strong>5.</strong> Նախնական ախտորոշում </div>
                <div class="bottom-line">{{$stationaries->stationary_diagnoses->where('diagnosis_type', \App\Enums\StationaryDiagnosisEnum::stationary_present_status_preliminary())->last()->diagnosis_comment ?? ""}}
                </div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>6.</strong> Ուղեգրող այլ հաստատություններ </div>
                <div class="bottom-line">{{$medicalCareAccounting->Clinic2_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>7.</strong> Ուղեգրի, գրության համարը N</div>
                <div class="bottom-line">{{$medicalCareAccounting['referral_N']}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>8.</strong> Ընդունման ամսաթիվը </div>
                <div class="bottom-line">

                    {{\Illuminate\Support\Carbon::parse($stationaries->admission_date ?? "")->format('Y-m-d')}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>9.</strong> Ընդունման ժամը</div>
                <div class="bottom-line">{{\Illuminate\Support\Carbon::parse($stationaries->admission_date ?? "")->format('H:i')}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>10.</strong> Դուրս գրման ամսաթիվը</div>
                <div class="bottom-line">{{$stationaries->discharge_date ?? ""}}</div>
            </div>
            <br>

            <div class="display-flex">
                <div><strong>11.</strong> ՀԻվանդության ելքը</div>
                <div class="bottom-line"> @php
                        $stationary_disease_outcomes = $stationaries->stationary_disease_outcomes;
                        $outcome = !is_null($stationary_disease_outcomes) ? $stationaries->stationary_disease_outcomes->outcome->getValue() : "";
                $outcome_lng = $outcome ? __("enums.stationary_disease_outcome_enum.{$outcome}") : "";

                    @endphp
                    {{$outcome_lng}}
                </div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>12.</strong> Հիվանդի անուն, ազգանունը</div>
                <div class="bottom-line">{{$patient->full_name}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>13.</strong> Ծննդյան ամսաթիվը</div>
                <div class="bottom-line">{{$patient->birth_date}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>14.</strong> Սեռը</div>
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
                <div><strong>15.</strong> Անձը հաստատող փաստաթղթի տեսակը (համարը)</div>
                <div class="bottom-line">{{$patient->passport}}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>16.</strong> Մշտական բնակության վայրը(հասցեն)</div>
                <div class="bottom-line">{{$patient->residence_region}}} {{$patient->street_house}}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>17.</strong> Հեռախոսահամար</div>
                <div class="bottom-line">{{$patient->m_phone}},{{$patient->c_phone}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>18.</strong> Սոց․ կամ հատուկ խմբի կոդը, փաստաթղթի համարը N</div>
                <div class="bottom-line">{{$medicalCareAccounting['social_package_comments']}}</div>
            </div>
            <br>
            <p></p>


            <div class="display-flex">
                <div>Անձի նույնականացման համարը N</div>
                <div class="bottom-line">{{$patient->soc_card}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>19.</strong> Հիվանդության պատմության համարը N </div>
                <div class="bottom-line">{{$medicalCareAccounting->stationary_Name->number ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>20.</strong> Հաշվետվության համարը N</div>
                <div class="bottom-line">{{$medicalCareAccounting['ReportNumberN']}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>21.</strong> Հոսպիտալացման բաժանմունքի համարը N </div>
                <div class="bottom-line">{{$medicalCareAccounting->Department_Hospital_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>22.</strong> Մատուցված ծառայության տեսակը մ/օր</div>
                <div class="bottom-line">{{$medicalCareAccounting->Service_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>23.</strong> Պետպատվերի հոդվածը</div>
                <div class="bottom-line">{{$medicalCareAccounting->Scholarships_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>24.</strong> Հիմնական կլինիկական եզրափակիչ ախտորոշումը </div>
                <div class="bottom-line">բարորակ ուռուծք</div>
            </div>
            <br>
            <p>{{$medicalCareAccounting['field_comments']}}</p>

            <br>

            <div class="display-flex">
                <div><strong>25.</strong> Տեղափոխված է (բաժանմունքի անվանումը)</div>
                <div class="bottom-line">{{$medicalCareAccounting->Department_Name->name}}</div>
            </div>

            <br>


            <div class="display-flex">
                <div><strong>26.</strong> Մատուցված ծառայության տեսակը մ/օր</div>
                <div class="bottom-line">{{$medicalCareAccounting->Service2_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>27.</strong> Պետպատվերի հոդվածը</div>
                <div class="bottom-line">{{$medicalCareAccounting->Scholarships2_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>28.</strong> Տեղափոխված է (բաժանմունքի անվանումը)</div>
                <div class="bottom-line">Կլինիկական</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>29.</strong> Մատուցված ծառայության տեսակը մ/օր</div>
                <div class="bottom-line">{{$medicalCareAccounting->Service3_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>30.</strong> Պետպատվերի հոդվածը</div>
                <div class="bottom-line">{{$medicalCareAccounting->Scholarships3_Name->name ?? ' '}}</div>
            </div>

            <br>

            <div><strong>31․</strong> Համալրման տեսակը</div>
            <p>{{$medicalCareAccounting['replenishment_type']}}</p>

            <br>

            <div><strong>32․</strong> Համալրման չափը</div>
            <p>{{$medicalCareAccounting['replenishment_size']}}</p>

            <br>

            <div><strong>33.</strong> Ուղեկցվող Հիվանդություններ</div>
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

            <div><strong>34.</strong> Բարդություններ</div>
            <p>    @forelse ($stationaries->stationary_diagnoses->where("diagnosis_type",
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

                            @endforelse</p>

            <br>

            <div><strong>35.</strong> Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ</div>
            <br>
                            <table class="text-center surgery">
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
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>

            <br> <br>

            <div><strong>36.</strong> Օգտագործված դեղ և բժշկական նշանակության ապրանքներ</div>
            <br>
            <?php $source= [
                "a" => "Պետ պատվեր" ,
                "b" => "Վճարովի" ,
                "c" => "Հիվանդի կողմից" ,
                "d" => "Հումանիտար օգնություն"
            ];
            ?>
            <table class="text-center">
                <tr>
                    <th>Աղբյուր</th>
                    <th>
                        Անվանումը,դեղաձևը <br>
                        դեղաչափը և թողարկման ձևը <br>
                        (փաթեթավորումը)
                    </th>
                    <th>գրառման</th>
                    <th>Քանակ</th>


                </tr>
                <tr>
                @foreach($medicineData as $medicineData_exits)

                    <tr id="trashData{{$medicineData_exits->id}}">
                        <td>{{$source[$medicineData_exits->source_id] ?? ' '}}</td>
                        <td>{{$medicineData_exits->medicine_name->name ?? ' '}}</td>
                        <td>{{$medicineData_exits->medicine_comments}}</td>
                        <td>{{$medicineData_exits->medicine_count}}</td>

                    </tr>
                    @endforeach



                </tr>
            </table>

            <br> <br>

            <div><strong>37.</strong> Կատարված լաբորատոր և գործիքային հետազոտություններ</div>
            <br>
            <table class="text-center">
                <tr>
                    <th>Անվանում</th>
                    <th>գրառման</th>
                    <th>Քանակ</th>

                </tr>
                @foreach($labService as $labServices)
                    <tr id="trashDataService{{$labServices->id}}">
                        <td>{{$labServices->LabServiceName->name ?? ' '}}</td>
                        <td>{{$labServices->lab_comments}}</td>
                        <td>{{$labServices->lab_count}}</td>

                    </tr>
                @endforeach
            </table>

            <br>
            <br>

            <div class="display-flex">
                <div><strong>Բժիշկ</strong></div>
                <div class="bottom-line">{{$medicalCareAccounting->ResponsibleNurse->full_name ?? ' '}} </div>
            </div>

            <br>

            <div class="display-flex">
                <div><strong>Մուտքագրող</strong></div>
                <div class="bottom-line">{{$medicalCareAccounting->user->full_name ?? ' '}}</div>
            </div>


            <br>
            <br>

        </div>
    </div>
</div>
</body>
</html>
