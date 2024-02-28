<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/ultrasound_endoscopic_examination.css')}}">
    <title>Էնդոսկոպիկ և ուլտրաձայնային հետազոտություն</title>
    @php
        $is_pdf = $for_pdf ?? false;
    @endphp
    @if ($is_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>

<div class="page-wrap">
    <div class="new-page">
        <div class="main-container">
            <br><br>
            <div class="container-line2">
                <div class="top-title">
                    Հ.Հ Վ.Ա. ՖԱՆԱՐՋՅԱՆԻ անվան
                    ՈՒՌՈՒՑՔԱԲԱՆԱԿԱՆ ԱԶԳԱՅԻՆ
                    ԿԵՆՏՐՈՆ,<br>
                    <small> Երևան,Ֆանարջյան</small>76,<br>
                    Tel: +37410236829; +37410286731
                    <a href="https://oncology.am/">https://oncology.am/</a>
                </div>
            <div class="logo"><img src="{{asset('assets/img/avatars/f-logo.jpg')}}"></div>
            <div>Национальный Центр Онкологии <br>
                МЗРА 0052,Ереван <br>
                <small>ул.Фанарджяна </small>76,<br>
                Natiaonal Center of Oncology MoH <br>
                RA <br>
                0052,Yerevan,Fanarjyan St.76
            </div>
            </div>
            <br>
            <br>
            <div class="text-center"><strong>Էնդոսկոպիկ և ուլտրաձայնային հետազոտություն</strong></div>
            <br><br>
            <div>Հետազոտության տեսակ</div>
            <p>
                {{$uex->research_type}}
            </p>
            <br>
            <div class="display-flex">
                <div>Հիվանդի -Ա.Ա.</div>
                <div class="bottom-line">{{$patient->full_name}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Ծննդյան տարեթիվ</div>
                <div class="bottom-line">{{$patient->birth_date}}</div>
            </div>

            <br><br>
            <div>Նկարագիր</div>
            <p>{{$uex->description_comment}}</p>
            <br>
            <div>Եզարակացություն</div>
            <p>{{$uex->conclusion_comment}}</p>
            <br>
            <div>Խորհուրդ է տրվում</div>
            <p>{{$uex->recommended_comment}}</p>
            <br>

            <div class="display-flex">
                <div>Բժիշկ՝ Ա․Ա․ </div>
                <div class="bottom-line">{{$uex->attending_doctor->full_name}}</div>
            </div>
            <br>
            <div class="display-flex">
                    <div>Ամսաթիվ</div>
                    <div class="bottom-line">{{$uex->date}}</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
