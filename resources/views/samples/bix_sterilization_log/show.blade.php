
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/print/bix_sterilization_log.css') }}">

    <title>Բիքսի մանրէազերծման գրանցամատյան</title>
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
            <div class="text-center"><strong>ԲԻՔՍԻ ՄԱՆՐԷԱԶԵՐԾՄԱՆ ԳՐԱՆՑԱՄԱՏՅԱՆ</strong> </div>
            <br>
                <table class="table2">
                    <tr>
                        <th>Հերթական համար</th>
                        <th>Ամսաթիվ</th>
                        <th>Բիքսի ուղարկման ժամ</th>
                        <th>Բիքսի բերման ժամանակ</th>
                        <th>Վիրահատական սեղանի պատրաստման ժամ</th>
                    </tr>
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->bix_sterilisation_date }}</td>
                        <td>{{ $post->bix_send_date }}</td>
                        <td>{{ $post->bix_surgery_date }}</td>
                        <td>{{ $post->surgery_table_preparation }}</td>
                    </tr>
                </table>
            </div>
        </div>

    <div class="main-container">
        <br><br>
        <div class="display-flex">

            <br>
            <div>Դիտողություններ</div>
            <div>Примечание</div>
            <p>{{ $post->remarks }}</p>
            <br>


            <div>Վիրահատական սեղանի բուժքույր </div>

            <div class="bottom-line">Alla Karapetyan</div>
        </div>
        <br><br>
        <div class="bottom-line"></div>
        <div class="text-center">ստորագրություն</div>
        <br><br>
        <div class="display-flex">
            <div>Գլխավոր բուժքույր</div>
            <div class="bottom-line">Alla Karapetyan</div>
        </div>
        <br><br>
        <div class="bottom-line"></div>
        <div class="text-center">ստորագրություն</div>
    </div>
</div>
</body>
</html>
