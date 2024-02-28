<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/echocardiogram.css')}}">
    <title>ՄԱՆՐԷԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</title>
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
            <div class="text-center"><strong>ԲԺՇԿԱԿԱՆ ՁԵՎ N 2</strong></div>
            <br><br>
            <div class="display-flex">
                <div>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
                <div class="bottom-line">{{ $post->	medical_company_name }}</div>
            </div>
            <br><br>
            <div class="display-flex">
                <div>Ա․Ա․Հ․</div>
                <div class="bottom-line">{{ $post->patient->getAllNamesAttribute() }}</div>
            </div>
            <br>
            <div class="display-flex">
                <div class="">Տարիք</div>
                <div class="bottom-line">{{ $post->patient->getAgeAttribute() }}</div>
            </div>
            <br>

            <div class="display-flex">
                <div>Արյան մանրէաբանական հետազոտություն N </div>
                <div class="bottom-line">{{ $post->id }}</div>
            </div>
            <div class="display-flex">
                <div>Արյան բակտերիոլոգիական հետազոտության պատասխանի տրման ամսաթիվ</div>
                <div class="bottom-line">{{ $post->test_response_date }}</div>
            </div>
            <div class="display-flex">
                <div>Ամբուլատոր բժշկական քարտի/հիվանդության պատմագրի №</div>
            </div>


            <br><br>
            <table class="">
                <thead>
                    <tr>
                        <th>Բաժանմունք</th>
                        <th>Պալատ</th>
                        <th>Ուղեգրող բժիշկ</th>
                        <th>Բուժող բժիշկ</th>
                        <th>Կենսանյութը վերցնելու ամսաթիվ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $post->department->name }}</td>
                        <td>{{ $post->room }}</td>
                        <td>{{ $post->referred_doctor->getFullNameAttribute() }}</td>
                        <td>{{ $post->attending_doctor->getFullNameAttribute() }}</td>
                        <td>{{ $post->examination_date }}</td>
                    </tr>

                </tbody>
            </table>

            <br><br>
            <table>
                <thead>
                    <tr>
                        <th>Ստերիլություն</th>
                        <th>Տիֆ պարատիֆային խմբի հարուցիչներ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $post->sterilisation }}</td>
                        <td>{{ $post->tif_infection_info }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <br><br>
    <div class="new-page">
        <div class="main-container">
            <div class="float-left">Ստորագրություն</div>
        </div>

    </div>
</div>


</body>
</html>

