<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/print/biochemical_labs.css') }}">
    <title>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 5</title>
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
                <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 5</span></div>
                <br>
                <div class="text-center">Արյան էլեկտրոլիտների հետազոտություն N <span>{{$bl->bbe_number}}</span></div>
                <br>
                <div class="display-flex">
                    <div>Կենսանյութը վերցնելու ամսաթիվ</div>
                    <div class="bottom-line">{{$patient->f_name}} {{$patient->l_name}} {{$patient->p_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Անուն, ազգանուն, հայրանուն </div>
                    <div class="bottom-line">{{$patient->full_name}}</div>
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


                <div class="text-center"><strong>Արյան էլեկտրոլիտների հետազոտություն</strong> </div>
                <br><br>
                <table>
                    <tr>
                        <td>Ցուցանիշ</td>
                        <td>Արդյունքներ</td>
                        <td>Նորմա</td>
                    </tr>
                    <tr>
                        <td>Կալիում</td>
                        <td>{{$bl->calium}} <span>մմոլ/լ</span></td>
                        <td>3.4 – 5.3 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Նատրիում</td>
                        <td>
                            {{$bl->natrium}} <span>մմոլ/լ</span>
                        </td>
                        <td>135.0 – 155.0 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Կալցիում ընդհանուր</td>
                        <td>{{$bl->calcium_total}} <span>մմոլ/լ</span></td>
                        <td>2.1 – 2.6 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Կալցիում իոնիզացված</td>
                        <td>{{$bl->calcium_ionized}} <span>մմոլ/լ</span></td>
                        <td>1.13 – 1.32 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Ֆոսֆոր անօրգանական</td>
                        <td>{{$bl->inorganic_phosphorus}} <span>մմոլ/լ</span></td>
                        <td>0.81 – 1.55 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Քլորիդներ</td>
                        <td>{{$bl->chlorides}} <span>մմոլ/լ</span></td>
                        <td>95.0 – 110.0 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Քլորիդներ մեզի մեջ</td>
                        <td>{{$bl->chlorides_in_urine}} <span>մմոլ/լ</span></td>
                        <td>170.0 – 210.0 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Մագնեզիում</td>
                        <td>{{$bl->magnesium}} <span>մմոլ/լ</span></td>
                        <td>0.7 – 1.07 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Երկաթ</td>
                        <td>
                            Տ. {{$bl->iron_man}} <span>մկմոլ/լ</span> <br>
                            Կ. {{$bl->iron_wooman}} <span>մկմոլ/լ</span>
                        </td>
                        <td>
                            Տ. 14,3-25,1 մկմոլ/լ <br>
                            Կ. 10,7-21,5 մկմոլ/լ
                        </td>
                    </tr>
                </table>
                <br><br>

                <div class="display-flex">
                    <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                    <div class="bottom-line">{{$bl->sender_doctor->full_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Արյան էլեկտրոլիտների հետազոտության պատասխանի տրման ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->research_date}}</div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>
