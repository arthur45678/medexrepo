<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ambulator</title>
    <link rel="stylesheet" href="{{ mix('/css/print/ambulator.css') }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @if ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>
    <div class="page-wrap">
        <div class="flex-container">
            <div class="flex-item1">
                <div class="clinic-img"><img src="{{asset('assets/img/avatars/f-logo.jpg')}}"></div>
                <div class="data">
                    <p>
                        <h5>ՀՀ ԱՆ Վ․Ա Ֆանարջյանի Անվան Ուռուցքաբանական Ազգային Կենտրոն ՓԲԸ</h5>
                    </p>
                    Հեռ․(010) 28-70-52
                    <br>
                    <br>
                    Հաշվառման վերցնելու ամսաթիվ<br>
                    <p>{{$patient->ambulator['registration_date'] ?? ""}}</p>
                </div>
            </div>
            <div class="flex-item2">
                <div class="abulator">
                    <h2>Ամբուլատոր քարտ</h2>
                    <strong>N {{$ambulator['number']}}/{{date("Y") ?? ""}}</strong>
                    <br><br><br>
                </div>
                <div class="list">
                    <div class="display-flex">
                        <div class=""><strong>Ազգանուն</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->l_name ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Անուն</strong> </div>
                        <div class="bottom-line-m">{{$ambulator->patient->f_name ?? ""}} </div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Հայրանուն</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->p_name ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Ծննդյան թիվը</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->birth_date ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Ազգությունը</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->nationality ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Բնակավայր, մարզ</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->residence_region ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Քաղաք, գյուղ</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->town_village ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Փողոց</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->street_house ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Աշխատանքի վայրը </strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->workplace ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Մասնագիտությունը</strong> </div>
                        <div class="bottom-line-m">{{$ambulator->patient->profession ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>ՀԾՀՀ․</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->soc_card ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Անձնագիր</strong></div>
                        <div class="bottom-line-m">{{$ambulator->patient->passport ?? ""}}</div>
                    </div>

                    <div class="display-flex">
                        <div class=""><strong>Հեռախոս</strong>  </div>
                        <div class="bottom-line-m">{{$ambulator->patient->m_phone ?? ""}}</div>
                    </div>
                </div>
            </div>
            <div class="flex-item3">
                <br><br>
                <div class="">Սեռը՝
                    @if( gettype($ambulator->patient->is_male) === 'integer')
                        @if ($ambulator->patient->is_male)
                            տղամարդ
                        @else
                            կին
                        @endif
                    @else
                        նշված չէ
                    @endif
                </div>
                <br><br>
                <div class="" id='cancer-groups'>Կլինիկական Խումբ</div>
                <br>
                <div>
                </div>
                <table>
                    <tr>
                        <td>Ամսաթիվ</td>
                        <td>Խումբ</td>
                    </tr>
                    @forelse ($ambulator->patient->cancer_groups as $item)
                        <tr>
                            <td>{{date('d-m-Y', strtotime($item->pivot->created_at))}}</td>
                            <td>{{$item->name ?? ""}}</td>
                        </tr>
                        @empty

                    @endforelse
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <br><br><br><br>
        <div class="second-table">
            <div id="patient-harmfuls" class="harmfuls">
                <strong>Վնասակար սովորություններ, Վնասակար մասնագիտական գործոններ <br></strong>
                <p>
                    @forelse($ambulator->patient->harmfuls as $item)
                        {{$item['name'] ?? ""}}</td>
                        @empty

                    @endforelse
                </p>
            </div>
            {{-- </table > --}}
            <table id="ambulator-tnms">
                <thead>
                    <tr>
                        <th>TNM</th>
                        <th>Ամսաթիվ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patient->ambulator->tnms as $tnm)
                    <tr>
                        <td>
                            <p>
                                T -> {{$tnm->T ?? "'- - -'"}} N -> {{$tnm->N ?? "'- - -'"}} M -> {{$tnm->M ?? "'- - -'"}}
                            </p>
                            <p>
                                Grade -> {{$tnm->Grade ?? "'- - -'"}} L -> {{$tnm->L ?? "'- - -'"}} V -> {{$tnm->V ?? "'- - -'"}}
                            </p>
                            <p>
                                դասակարգում -> {{$tnm->pycmr ?? "'- - -'"}}
                            </p>
                        </td>
                        <td>{{$tnm->created_at}}</td>
                    </tr>

                    @empty
                    @endforelse
                </tbody>

            </table>
            <br>
            <table class="sec-table-height" id="first-infos">
                <tr>
                    <td>
                        <strong>Հիվանդի դիմելն առաջին անգամ <br>
                            (երբ և որտեղ)
                        </strong>
                    </td>
                    <td>
                        <strong>Հիվանդությունը առաջին անգամ <br>
                            հայտանաբերված է
                        </strong>
                    </td>
                </tr>
                @forelse ($first_info as $item)
                    <tr>
                        <td>{{$item->first_clinic_item->name  ?? "" }}- {{$item->first_clinic_date ?? ""}}</td>

                        <td>{{$item->first_discovered_item->name ?? ""}}- {{$item->first_discovered_date ?? ""}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    @empty

                @endforelse
            </table>
            <br>
            <table>
                <tr>
                    <td>
                        <strong>
                            Անցյալում ստացած բուժումները
                        </strong>
                    </td>
                </tr>
                @forelse($ambulator->patient->first_info as $item)
                    <tr>
                        <td>{{$item->past_treatments ?? ""}}</td>
                    </tr>
                    @empty

                @endforelse
            </table>
        </div>
        <br><br>
        <div>
            <div class="doctor-container" id="preliminary_diagnosis">
                <strong>Նախնական ախտորոշում</strong>
                @php
                    $preliminary = $ambulator->preliminary_diagnosis();
                    $preliminary_disease_item = $preliminary->disease_item ?? null;
                @endphp
                    <br><br>
                    <em>կոդ՝</em> {{ $preliminary_disease_item->code ?? ""}} <br>
                    <em>անվանում՝</em> {{ $preliminary_disease_item->name ?? ""}} <br>
                    <em>լրացում՝</em> {{ $preliminary->diagnosis_comment ?? ""}} <br><br>
                    <div class="float-left"><strong>Ամսաթիվ</strong> </div>
                    <div class="bottom-line float-left">{{ $preliminary->diagnosis_date ?? ""}}</div>
                    <br> <br>
                    <div class="float-left"><strong>Բժշկի ստորագրություն</strong></div>
                    <div class="bottom-line float-left">{{  $preliminary->user->full_name ?? ""}}</div>
                    <br>
                    <p></p>

                    <br>
                    <div id="final_diagnosis"><strong>Վերջնական ախտորոշում</strong> </div>
                @php
                    $final = $ambulator->final_diagnosis();
                    $final_disease_item = $final->disease_item ?? null;
                @endphp
                    <br>
                    <em>կոդ՝</em> {{$final_disease_item->code ?? ""}} <br>
                    <em>անվանում՝</em> {{$final_disease_item->name ?? ""}} <br>
                    <em>լրացում՝</em> {{$final->diagnosis_comment ?? ""}} <br><br>

                    <div class="float-left"><strong>Ամսաթիվ</strong></div>
                    <div class="bottom-line float-left">{{ $final->diagnosis_date ?? ""}}</div>
                    <br><br>
                    <div class="float-left"><strong>Բժշկի ստորագրություն</strong></div>
                    <div class="bottom-line float-left">{{  $final->user->full_name ?? ""}}</div>
                    <br>
                    <br>
                    <p></p>

                <br>
                <br>
            <div class="new-page">
                <div id="ambulator-attendances" class="doctor-container">
                    <p class="border-none"><strong>Հաճախումների հսկողություն</strong></p>
                    <table>
                        <tr>
                            <td id="td-width"> Ներկայացել է</td>
                            @forelse ($ambulator->attendances as $item)
                                <td>{{ $item->attendance_date }}</td>
                                @empty

                            @endforelse
                        </tr>
                    </table>
                </div>
                <br>
                <br>

                <div class="doctor-container-2">
                    <table>
                        <tr>
                            <td>
                                <strong>
                                    Ստացիոնար ընդունման <br>
                                    ամսաթիվ
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    Հիվանդության <br>
                                    պատմության N
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    Կատարված վիրահատության <br>
                                    ամսաթիվը
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    Դուրս գրման ամսաթիվը, <br>
                                    մահվան ամսաթիվը
                                </strong>
                            </td>

                        </tr>


                        @foreach ($stationaries as $item)
                        <tr>
                            <td>{{$item->admission_date}}</td>
                            <td>{{$item->number}}</td>
                            <td>{{$item->surgery_date}}</td>
                            <td>{{$item->discharge_date}}</td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <br>
            <br>
            @include('ambulators.show_page2', ['ambulator' => $ambulator])
            @include('ambulators.show_page3', ['ambulator' => $ambulator])
        </div>
    </div>
</body>
</html>
