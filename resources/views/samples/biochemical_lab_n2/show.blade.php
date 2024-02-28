<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/print/biochemical_labs.css') }}">
    <title>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 2</title>
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
                <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 2</span></div>
                <br>
                <div class="text-center">Լիպիդային սպեկտրի հետազոտություն N <span>{{$bl->bbe_number}}</span></div>
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


                <div class="text-center"><strong>Լիպիդային սպեկտրի հետազոտություն</strong> </div>
                <br><br>
                <table>
                    <tr>
                        <th>Ցուցանիշ</th>
                        <th>Արդյունքներ</th>
                        <th>Նորմա</th>
                    </tr>
                    <tr>
                        <td>Ընդհանուր խոլեստերին</td>
                        <td>{{$bl->total_cholesterol}} <span>մմոլ/լ</span></td>
                        <td>3.0 – 5.2 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>բետա–լիպոպրոտեիդներ</td>
                        <td>{{$bl->beta_lipoproteins}} <span>գ/լ</span></td>
                        <td>3.0 – 4.5 գ/լ</td>
                    </tr>
                    <tr>
                        <td>Ցածր խտությամբ լիպոպրոտեիդներ
                            (ԽՍ ՑԽԼՊ)
                        </td>
                        <td>{{$bl->low_density_lipoproteins}} <span>մմոլ/լ</span></td>
                        <td>1.56 – 4.94 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Շատ ցածր խտությամբ լիպոպրոտեիդներ
                            (ԽՍ ՇՑԽԼՊ
                        </td>
                        <td>{{$bl->very_low_density_lipoproteins}} <span>մմոլ/լ</span></td>
                        <td>0.26 – 1.04 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Բարձր խտությամբ լիպոպրոտեիդներ
                            (ԽՍ ԲԽԼՊ)
                        </td>
                        <td>{{$bl->high_density_lipoproteins}} <span>մմոլ/լ</span></td>
                        <td>0.78 – 1.82 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Տրիգլիցերիդներ</td>
                        <td>{{$bl->triglycerides}} <span>մմոլ/լ</span></td>
                        <td>0.45 – 1.86 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Աթերոգենության գործակից</td>
                        <td>
                            Տ. -{{$bl->atherogenic_coefficient_man}} <span>մմոլ/լ</span><br>
                            Կ. -{{$bl->atherogenic_coefficient_wooman}} <span>մմոլ/լ</span>
                        </td>
                        <td>
                            Տ. - մինչև 2.5 <br>
                            Կ. - մինչև 2.2
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
                    <div>Լիպիդային սպեկտրի հետազոտության պատասխանի տրման ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->research_date}}</div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>
