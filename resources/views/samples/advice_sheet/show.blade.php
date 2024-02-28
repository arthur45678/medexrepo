<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/advice_sheet.css')}}">
    <title>Խորհրդատվական թերթիկ</title>
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>
<div class="page-wrap">
    <div class="new-page">
        <div class="main-container">
            <br>
            <div class="display-flex">
                <div>ՀՀ առողջապահական նախարարության  <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Վ.Ֆանարջյան անվան </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>
                    Խորհրդատվական թերթիկ № <span class="bottom-line">{{ $post->id }}</span> <br>
                    Консультационный лист № <span class="bottom-line">{{ $post->id }}</span>
                </div>
            </div>
            <br>
            <div class="display-flex">
                <div>Ուռուցքաբանության ազագային կենտրոն </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>
                    Հիվանդի Ա.Ա.Հ. <span class="bottom-line">{{ $post->patient->getAllNamesAttribute() }}</span> <br>
                    Больной<span class="bottom-line">{{ $post->patient->getAllNamesAttribute() }}</span>
                </div>
            </div>
             <br>
             <div>Национальный центр онкологи <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; им. В.А. Фанарджяна <br> Министерцтва здравоохранения РА</div>
            <br>
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <span class="bottom-line">{{ $post->admission_date }}</span>
            </div>
            <br>
            <div>Ախտորոշում/Диагноз</div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Ախտորոշում</th>
                        <th>գրառում</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($samplesDiagnosis as $sampleDiagnose)
                    <tr>
                        <td>{{$sampleDiagnose->disease_item->name ?? ' '}}</td>
                        <td>{{$sampleDiagnose->diagnosis_comment}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <p></p>
            <div>Խորհուրդ է տրվում/Рекомендуется</div>
            <br>
            <p>{{ $post->recommended }}</p>
            <br>
            <div class="display-flex">
                <div>Կ.Տ <br> К.Т</div>&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $post->recommended }}
                <div>
                Խորհրդատուի Ա.Ա.Հ.  <span class="bottom-line"></span> <br>
                Ф.И.О. консультант<span class="bottom-line">{{ $post->consultant }}</span>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div>Ստորագրություն </div>
                     <span class="bottom-line1" style="height: 22px;width: 124px;"></span>

            </div>
            <br>
            <div class="display-flex">
                <div>
                    Պոլիկնիկական բաժ. վարիչ <span class="bottom-line">{{ $post->attending_doctor->f_name }} {{ $post->attending_doctor->l_name }}</span> <br>
                    Зав. поликлин. отд. <span class="bottom-line">{{ $post->attending_doctor->f_name }} {{ $post->attending_doctor->l_name }}</span>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                     <div>Ստորագրություն</div>
                     <span class="bottom-line1" style="height: 22px;"></span>

            </div>
        </div>
    </div>
</div>
</body>
</html>
