<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/print/biochemical_labs.css') }}">
    <title>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 1</title>
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
                <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 1</span></div>
                <br>
                <div class="text-center">Արյան կենսաքիմիական հետազոտություն N <span>{{$bl->bbe_number}}</span></div>
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


                <div class="text-center"><strong>Արյան կենսաքիմիական հետազոտություն</strong> </div>
                <table>
                    <tr>
                        <th>Ցուցանիշ</th>
                        <th>Արդյունքներ</th>
                        <th>Նորմա</th>
                    </tr>
                    <tr>
                        <td>Գլյուկոզ</td>
                        <td>{{$bl->glucose}}  <span>մմոլ/լ</span></td>
                        <td>3.3 – 5.5 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Միզանյութ</td>
                        <td>{{$bl->urine}} <span>մմոլ/լ</span></td>
                        <td>1.7 – 8.3 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Պրոթրոմբին</td>
                        <td>{{$bl->prothrombin}} <span>%</span></td>
                        <td>80 – 100 %</td>
                    </tr>
                    <tr>
                        <td>α-ամիլազ</td>
                        <td>{{$bl->amylase}} <span>Մ/լ</span></td>
                        <td>մինչև 90 Մ/լ</td>
                    </tr>
                    <tr>
                        <td>Ուռոամիլազ</td>
                        <td>{{$bl->uroamylase}} <span>Մ/լ</span></td>
                        <td>մինչև 1000 Մ/լ</td>
                    </tr>
                </table>

                <br><br>
                <div class="display-flex">
                    <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                    <div class="bottom-line">{{$bl->sender_doctor->full_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Արյան կենսաքիմիական հետազոտության պատասխանի տրման ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->research_date}}</div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>
