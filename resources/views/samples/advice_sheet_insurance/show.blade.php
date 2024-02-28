<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/advice_sheet_insurance.css')}}">
    <title>Խորհրդատվական ապահովագրական թերթիկ</title>
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
            <div class="text-center"> <strong>ՀՀ ԱՆ Վ.Ա. Ֆանարջյանի անվան ՈՒռուցքաբանության ազգային կենտրոն </strong> </div>
            <br>
            <div class="text-center"> <strong>ԽՈՐՀՐԴԱՏՎԱԿԱՆ  ԹԵՐԹԻԿ</strong> </div>
            <br>
            <div class="text-center">Տրվում է ներկայացնել ապահովագրական ընկերություն</div>
            <br>


            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <span class="bottom-line">{{ $post->admission_date }}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Ա.Ա.Հ.</div>
                <span class="bottom-line">{{ $post->patient->getAllNamesAttribute() }}</span>
            </div>
            <br>
            <div>Գանգատներ</div>
            <br>
            <p>{{ $post->complaints }}</p>
            <br>
            <div>Կատարված հետազոտություն</div>
            <br>
            <p>{{ $post->research_done }}</p>
            <br>
            <div>Ախտորոշում</div>
            <br>
            <p></p>
            <br>
            <div>Վիրահատության ցուցումներ</div>
            <br>
            <p>{{ $post->Indications_for_surgery }}</p>
            <br>
            <div>Վիրահատության ծավալ</div>
            <br>
            <p>{{ $post->volume_of_surgery }}</p>
            <br>
            <div>Բաժանմունք</div>
            <br>
            <p>{{ $post->department }}</p>
            <br>
            <div>Կ.Տ.</div>
            <br>
            <div class="display-flex">
                <div>Բժիշկ</div>
                <span class="bottom-line">{{ $post->attending_doctor->full_name }}</span>
            </div>
            <br>
            <div class="display-flex">
                <div>Տնօրեն</div>
                <span class="bottom-line">{{ $post->department_head->full_name }}</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
