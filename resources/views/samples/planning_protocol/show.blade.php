<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/planning_protocol.css')}}">
    <title>ՊԼԱՆԱՎՈՐՄԱՆ-ԱՐՁԱՆԱԳՐՈՒԹՅՈՒՆ</title>
</head>
<body>
<div class="page-wrap">
    <div class="main-container">
        <div class="new-page">
            <br><br>
            <div class="text-center"><strong>ՊԼԱՆԱՎՈՐՄԱՆ-ՈՒՂԵԳԻՐ</strong></div>
            <br><br>
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div
                    class="bottom-line">{{\Illuminate\Support\Carbon::parse($planing->parent_date)->format('Y-m-d H:i')}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Բուժման նախատեսվող սկիզբ</div>
                <div
                    class="bottom-line">{{\Illuminate\Support\Carbon::parse($planing->date_treatment)->format('Y-m-d H:i')}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Բուժասարք</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span>{{$planing->device}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            </div>
            <p>{{$planing->medical_device}}</p>
            <br>
            <div class="display-flex">
                <div>Portal imaging</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span>{{__('samples.'.$planing->portal)}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <p>{{$planing->portal_imaging}}</p>
            <br>
            <div class="display-flex">
                <div>CT / MRI fusion</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span>{{__('samples.'.$planing->fusion)}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            </div>
            <p>{{$planing->MRI_fusion}}</p>
            <br>
            <div class="display-flex">
                <div>Կուրսը</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span>{{__('samples.'.$planing->course)}}</span>
            </div>
            <p>{{$planing->course_info}}</p>
            <br>
            <br>
            <div class="display-flex">
                <div>Բաժնևորում</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <span>{{__('samples.'.$planing->section)}}</span>
            </div>
            <p></p>
            <br>
            <div class="display-flex">
                <div class="display-flex">
                    <div>ՄՕԴ</div>
                    <div class="bottom-line">{{$planing->MOD_info}}</div>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="display-flex">
                    <div>ԳՕԴ</div>
                    <div class="bottom-line">{{$planing->GOD_info}}</div>
                </div>
            </div>
            <br>

            <div class="display-flex">
                <div>Boost</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span>{{__('samples.'. $planing->boost)}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            </div>
            <p>{{$planing->boost_info}}</p>

            <br>
            <div>Ռիսկի օրգաններ</div>
            <p>{{$planing->risk_organs}}</p>
            <br>
            <div>Հատուկ նշումներ</div>
            <p>{{$planing->special_notes}}</p>
            <br>
            <br><br><br>
            <div class="float-left">Կատարող ֆիզիկոս</div>
            <div class="float-left bottom-line">{{$planing->Performing_physicist->full_name ?? ' '}}</div>

            <br><br><br>
            <div class="float-left ">Բուժող բժիշկ</div>
            <div class="float-left bottom-line">{{$planing->healerdoctor->full_name ?? ' '}}</div>
            <br><br>
            <br><br>
        </div>
        <div class="new-page">
            <div class="text-center"><strong>ՀՇ ՊԼԱՆԱՎՈՐՄԱՆ-ԱՐՁԱՆԱԳՐՈՒԹՅՈՒՆ</strong></div>
            <br><br>
            <div class="display-flex">
                <div class="img-man">
                    <img src="{{asset('assets/img/avatars//samples/Man.jpg')}}" style="height: 100%" ;>
                </div>
                <div class="container">
                    <div class="title"><strong>Լրացնում է ճառագայթային ուռուցքաբանը</strong></div>
                    <br>
                    <div class="display-flex">
                        <div>Ամսաթիվ</div>
                        <div class="bottom-line">{{\Illuminate\Support\Carbon::parse($planing->date)->format('Y-m-d H:i')}}</div>
                    </div>
                    <br>
                    <div class="display-flex">
                        <div>Հիվանդ (ԱԱՀ)</div>
                        <span class="bottom-line">{{$patent->full_name ?? ' '}}</span>
                    </div>
                    <br>
                    <div class="display-flex">
                        <div>Հ/պ</div>
                        <div class="bottom-line">1</div> &nbsp;&nbsp;&nbsp;
                        <div>Ա/ք</div>
                        <div class="bottom-line">2</div> &nbsp;&nbsp;&nbsp;
                        <div>ID</div>
                        <div class="bottom-line">1</div>
                    </div>
                    <br>
                    <div>Ախտորոշում</div>
                    @foreach($planingdiagnostic as $planingdiagnostics)
                    <p>{{$planingdiagnostics->medicine_name->name ?? ' '}} - {{$planingdiagnostics->diagnosis_comment ?? ' '}}</p>
                    @endforeach
                    <br>
                    <div>Հետազոտվող հատվածը և քայլը (մմ)</div>
                    <p>{{$planing->section_step}}</p>
                    <br>
                    <div class="display-flex">

                        <div>Հիվանդի դիրքը</div> &nbsp;&nbsp;
                        <div>{{__('samples.'. $planing->position)}}</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <br>
                    </div>
                    <p>{{$planing->patient_position}}</p>
                    <div class="display-flex">
                        <div>Կոնտրաստ</div> &nbsp;&nbsp;
                        <div>{{__('samples.'.$planing->contrast)}}</div>
                        <br>
                    </div>
                    <p>{{$planing->contrast_info}}</p>
                </div>
            </div>
            <br>
            <table class="table">
                <tr>
                    <th colspan="7">Լրացնում է ճառագայթային տեխնիկը</th>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="text-center">Breast board № <span class="bottom-line">{{$planing->breast}}</span></div>
                    </td>
                    <td colspan="3">
                        <div class="text-center">{{$planing->belly_board}}</div>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <div class="text-center">N1 (Med-Tec)</div>
                    </td>
                    <td colspan="2">
                        <div class="text-center">N2(Q-flx)</div>
                    </td>
                    <td colspan="3" rowspan="2">
                        <div class="display-flex">
                            <div class="bottom-line">{{__('samples.'.$planing->board)}}</div>
                        </div>
                        <br>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="display-flex">
                            <div>Բարձրություն</div>
                            <div class="bottom-line">{{$planing->n1_height}}</div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="display-flex">
                            <div>Անկյուն</div>
                            <div class="bottom-line">{{$planing->corner}}</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="display-flex">
                            <div>Գլխատակ</div>
                            <div class="bottom-line">{{$planing->n1_headache}}</div>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="display-flex">
                            <div>Գլխատակ</div>
                            <div class="bottom-line">{{$planing->n2_headache_info}}</div>
                        </div>
                    </td>
                    <td colspan="3" rowspan="6">
                        <div class="display-flex">
                            <div>Դիմակ</div> &nbsp;&nbsp;&nbsp;&nbsp;
                            <div>{{__('samples.'.$planing->mask)}}</div>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Նշումներ</div> &nbsp;&nbsp;&nbsp;&nbsp;
                            <div>{{$planing->notes}}</div>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Սպիի նշումներ</div> &nbsp;&nbsp;&nbsp;&nbsp;
                            <div>{{__('samples.'.$planing->scar_notes)}}</div>

                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Կրծքագեղձի նշում</div> &nbsp;&nbsp;&nbsp;&nbsp;
                            <div>{{__('samples.'.$planing->breast_notes)}}</div>


                        </div>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <div class="text-center">Ձեռքեր</div>
                    </td>
                    <td colspan="2">
                        <div class="text-center">Ձեռքեր</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">{{__('samples.'. $planing->n1_hand)}}</td>



                    <td colspan="2">{{__('samples.'. $planing->n2_hand)}}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="display-flex">
                            <div>Կամար դիրքը</div>
                            <span class="bottom-line">{{$planing->arched_position}}</span>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>բարձրություն(H)</div>
                            <span class="bottom-line">{{$planing->n2_height}}</span>
                        </div>
                        <br>
                    </td>

                </tr>
                <tr>
                    <td colspan="4">
                        Գլխատակ / подголовник

                        <span class="bottom-line"> {{$planing->n2_headache}}</span>
                    </td>

                </tr>
                <tr>
                    <td colspan="4" rowspan="1">
                        <div>Հատուկ նշումներ</div>
                        <p>{{$planing->n2_special_notes}}</p>

                </tr>
            </table>
            <br><br><br>
            <div class="float-left">Կատարող</div>
            <div class="float-left bottom-line">{{$planing->Performer->full_name ?? ' '}}</div>
            <br><br><br>
            <div class="float-left ">Բուժող բժիշկ</div>
            <div class="float-left bottom-line">{{$planing->healer_doctorN2->full_name ?? ' '}}</div>

            <br><br>
        </div>
    </div>
</div>
</div>
</body>
</html>
