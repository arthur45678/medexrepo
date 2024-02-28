<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/immunological_examination_pattern_n5.css')}}">
    <title>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 5</title>
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
                <div class="text-center"><strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 5</strong></div>
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
                    <span class="bottom-line">{{$immunologia->department->name ?? ' '}}</span>
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
                <div class="text-center"> <strong>ՇՃԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ</strong> </div>
                <br>
                <br>
                <div>Ռեզուս գործոն</div>
                <br>
                <p>{{$immunologia->rhesus_factor}}</p>
                <br>
                <div>Արյան խումբ</div>
                <br>
                <p>{{$immunologia->blood_group}}</p>
                <br>
                <div>RPR (պրեցիպիտացիայի ռեակցիա)</div>
                <br>
                <p>{{$immunologia->RPR}}</p>
                <br>
                <div class="display-flex">
                    <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                    <span class="bottom-line">{{$immunologia->attendingdoctor->full_name ?? ' '}}</span>
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
