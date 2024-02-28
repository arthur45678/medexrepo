<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/print/biochemical_labs.css') }}">
    <title>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 8</title>
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
                <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 8</span></div>
                <br>
                <div class="text-center">Արյան կենսաքիմիական հետազոտություն N <span>{{$bl->bbe_number}}</span></div>
                <br>
                <div class="display-flex">
                    <div>Կենսանյութը վերցնելու ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->biopsy_date}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Անուն, ազգանուն, հայրանուն</div>
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
                <br><br>
                <table>
                    <tr>
                        <td>Ցուցանիշ</td>
                        <td>Արդյունքներ</td>
                        <td>Նորմա</td>
                    </tr>
                    <tr>
                        <td>Ընդհանուր սպիտակուց /PT/</td>
                        <td>{{$bl->common_protein}} <span>գ/լ</span></td>
                        <td>65 – 85 գ/լ</td>
                    </tr>
                    <tr>
                        <td>Ընդհանուր բիլիռուբին</td>
                        <td>
                            {{$bl->total_bilirubin}} <span>մկմոլ/լ</span>
                        </td>
                        <td>8.55 – 20.5 մկմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>կապված բիլիռուբին</td>
                        <td>{{$bl->related_bilirubin}} <span>մկմոլ/լ</span></td>
                        <td>0 – 5.1 մկմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>ազատ բիլիռուբին</td>
                        <td>{{$bl->free_bilirubin}} <span>մկմոլ/լ</span></td>
                        <td>8.55 – 15.4 մկմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Թիմոլային փորձ</td>
                        <td>{{$bl->timol_experience}} <span>միավոր</span></td>
                        <td>0 – 5 միավոր</td>
                    </tr>
                    <tr>
                        <td>Միզանյութ</td>
                        <td>{{$bl->urine}} <span>մմոլ/լ</span></td>
                        <td>2.5 – 8.3 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Գլյուկոզ</td>
                        <td>{{$bl->glucose}} <span> մմոլ/լ</span></td>
                        <td>6.4 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Ասպարտատամինոտրասֆերազա (ԱՍՏ)</td>
                        <td>{{$bl->aspartate_aminotransferase}} <span>Մ/լ</span></td>
                        <td>մինչև 37 Մ/լ</td>
                    </tr>
                    <tr>
                        <td>Ալանինամինոտրանսֆերազա(ԱԼՏ)</td>
                        <td>
                            {{$bl->alanine_aminotransferase}} <span>Մ/լ</span>
                        </td>
                        <td>մինչև 42 Մ/լ</td>
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
