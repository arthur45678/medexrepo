<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/print/biochemical_labs.css') }}">
    <title>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 7</title>
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>
    <div class="page-wrap">
        <div class="main-container">
            <div class="new-page">
                <br><br>
                <div class="text-center">ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
                <p class="text-center">Բ․Ա.Ֆանարջյանի անվան ուռուցքաբանության ազգային կենտրոն ՓԲԸ</p>

                <div class="text-center">ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</div><br>
                <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 7</span></div>
                <br>
                <div class="text-center">ԿՈԱԳՈՒԼՈԳՐԱՄԱ N <span>{{$bl->bbe_number}}</span></div>
                <br>
                <div class="display-flex">
                    <div>Կենսանյութը վերցնելու ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->biopsy_date}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Անուն, ազգանուն, հայրանուն </div>
                    <div class="bottom-line">{{$patient->f_name}} {{$patient->l_name}} {{$patient->p_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div> Տարիք </div>
                    <div class="bottom-line">{{$patient->age}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Բաժանմունք</div>
                    <div class="bottom-line">{{$bl->department->name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Պալատ</div>
                    <div class="bottom-line">{{$bl->chamber}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Ուղեգրող բժշկի անուն, ազգանուն</div>
                    <div class="bottom-line">{{$bl->attending_doctor->full_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Ամբուլատոր բժշկական քարտի</div>
                    <div class="bottom-line">{{$ambulator_id}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Հիվանդության պատմագրի N</div>
                    <div class="bottom-line">{{$bl->stationary_id}}</div>
                </div>
                <br><br>


                <div class="text-center"><strong>ԿՈԱԳՈՒԼՈԳՐԱՄԱ</strong> </div>
                <br><br>
                <table>
                    <tr>
                        <td>Ցուցանիշ</td>
                        <td>Արդյունքներ</td>
                        <td>Նորմա</td>
                    </tr>
                    <tr>
                        <td>Պրոթրոմբինային ժամանակ /PT/</td>
                        <td>{{$bl->prothrombin_time}} <span></span></td>
                        <td>12`-16`</td>
                    </tr>
                    <tr>
                        <td>Պրոթրոմբինային ինդեքս /iPT/</td>
                        <td>
                            {{$bl->prothrombin_index}} <span>%</span>
                        </td>
                        <td>80-105 %</td>
                    </tr>
                    <tr>
                        <td>Պլազմայի տոլերանտությունը հեպարինի նկատմամբ</td>
                        <td>{{$bl->plasma_tolerance}} <span>րոպե</span></td>
                        <td>3-6 րոպե</td>
                    </tr>
                    <tr>
                        <td>Ֆիբրինոգեն /FG/</td>
                        <td>{{$bl->fibrinogen}} <span>գ/լ</span></td>
                        <td>2-4 գ/լ</td>
                    </tr>
                    <tr>
                        <td>Ֆիբրինոգեն «Բ» /FG «B»</td>
                        <td>{{$bl->fibrinogen_b}} <span></span></td>
                        <td>( - )</td>
                    </tr>
                    <tr>
                        <td>Միջազգային նորմալիզացված հարաբերություն /INR/</td>
                        <td>{{$bl->normalized_international}} <span></span></td>
                        <td>1-1,8</td>
                    </tr>
                    <tr>
                        <td>Ակտիվ մասնակի տրոմբոպլաստինային ժամանակ /APTT/</td>
                        <td>{{$bl->active_thromboplastin}} <span</span></td>
                        <td>25`-35`</td>
                    </tr>
                    <tr>
                        <td>Թրոմբինային ժամանակ /TT/</td>
                        <td>{{$bl->thrombin_time}} <span></span></td>
                        <td>15`-20`</td>
                    </tr>
                    <tr>
                        <td>Դդիմեր /D-dimer/</td>
                        <td>
                            {{$bl->ddimer}} <span>մկգ/լ</span>
                        </td>
                        <td>< 250 մկգ/լ</td>
                    </tr>
                </table>
                <br><br>

                <div class="display-flex">
                    <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                    <div class="bottom-line">{{$bl->sender_doctor->full_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>ԿՈԱԳՈՒԼՈԳՐԱՄԱ հետազոտության պատասխանի տրման ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->research_date}}</div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>
