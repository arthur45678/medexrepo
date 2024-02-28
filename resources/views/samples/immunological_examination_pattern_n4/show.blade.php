<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/immunological_examination_pattern_n4.css')}}">
    <title>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 4</title>
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
                <br>
                <div class="text-center">ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
                <p></p>
                <br><br>
                <div class="text-center"><strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 4</strong></div>
                <br>
                <div class="display-flex">
                    <div>Շճաբանական հետազոտություն N</div>
                    <span class="bottom-line">{{$immunologia->research}}</span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Կենսանյութը վերցնելու ամսաթիվ</div>
                    <span class="bottom-line">{{$immunologia->date}}</span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Ազգանուն, անուն, հայրանուն</div>
                    <span class="bottom-line">{{$patent->full_name}}</span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Տարիք</div>
                    <span class="bottom-line">{{$patent->birth_date}}</span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Բաժանմունք</div>
                    <span class="bottom-line">{{$immunologia->departments->name ?? ' '}}</span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Պալատ</div>
                    <span class="bottom-line">{{$immunologia->hospital_room_number}}</span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Ուղեգրող բժշկի անուն, ազգանուն</div>
                    <span class="bottom-line">{{$immunologia->doctor->full_name ?? ' '}}</span>

                </div>
                <br>
                <div class="display-flex">
                    <div class="display-flex">
                        <div>Ամբուլատոր բժշկական քարտի N</div>
                        <span class="bottom-line">{{$amboulator->number ?? ' '}}</span>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="display-flex">
                        <div>Հիվանդության պատմագրի N</div>
                        <span class="bottom-line">{{$stationarie->number ?? ' '}}</span>
                    </div>
                </div>
                <br>
                <br>
                <div class="text-center"> <strong>ՎԱՀԱՆԱԳԵՂՁԻ ԵՎ ՀԱՐՎԱՀԱՆԱԳԵՂՁԻ ՀՈՐՄՈՆՆԵՐԻ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ</strong> </div>
                <br>
                <br>
                <div class="display-flex">
                    <div>TTG /Թիրեոտրոպին/</div>
                    <span class="bottom-line">{{$immunologia->TTG}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 0,27-4,2_մIՍ/mL</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>T3 /Եռյոդթիրոնին ընդհանուր/</div>
                    <span class="bottom-line">{{$immunologia->T3}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 1,2-3,16__պկմ/լ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>F T3 /Եռյոդթիրոնին ազատ/</div>
                    <span class="bottom-line">{{$immunologia->F_T3}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 4,4-9,3 պկմ/լ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>T4 /Թիրոքսին ընդհանուր/</div>
                    <span class="bottom-line">{{$immunologia->T4}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 60-165 նմ/լ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>F T4 /Թիրոքսին ազատ/</div>
                    <span class="bottom-line">{{$immunologia->F_T4}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 10-24 պկմ/լ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>TG /Թիրեոգլոբուլին/</div>
                    <span class="bottom-line">{{$immunologia->TG}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 0-50նգ/մլ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Aոti TG /հակաթիրեոգլոբուլին հակամարմիններ/</div>
                    <span class="bottom-line">{{$immunologia->Aոti_TG}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 0-40 մմ/մլ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Aոti TPO /հակաթիրեոիդպերօքսիդազ հակամարմիններ/</div>
                    <span class="bottom-line">{{$immunologia->Aոti_TPO}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - &#60;35մմ/մլ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>CTN /Կալցիտոնին/</div>
                    <span class="bottom-line">{{$immunologia->CTN}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 5,5-28 պկմ/լ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>PTH /պարատ հորմոն/</div>
                    <span class="bottom-line">{{$immunologia->PTH}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>Նորմա - 15,0-65,0 պգ/մլ</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Հետազոտությունը կատարվել է</div>
                    <span class="bottom-line">{{$immunologia->research_done}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>վերլուծիչով</div>
                </div>
                <br>

                <div class="display-flex">
                    <div>Հետազոտությունը իրականացնող բժիշկ</div>
                    <span class="bottom-line">{{$immunologia->Attending_doctor->full_name ?? ' '}}</span>

                </div>
                <br>
                <div class="display-flex">
                    <div>Ստորագրություն</div>
                    <span class="bottom-line1"></span>
                </div>
                <br>
                <div class="display-flex">
                    <div>Շճաբանական հետազոտության պատասխանի տրման ամսաթիվ</div>
                    <span class="bottom-line">{{$immunologia->date_research}}</span>
                </div>
            </div>
        </div>
</div>
</body>
</html>
