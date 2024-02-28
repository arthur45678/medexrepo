<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/stationary_inpatient_register.css')}}">
    <title>Ստացիոնար հիվանդների հաշվառման գրանցամատյան</title>
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
            <br><br>
            <div class="text-center"><strong>Ստացիոնար հիվանդների հաշվառման գրանցամատյան</strong></div>
            <br><br>
            <table>
                <tr>
                    <td>No</td>
                    <td>Յիվանդության պատմության թերթիկիNo</td>
                    <td>ՊՊ</td>
                    <td>Վճարովի</td>
                    <td>Ընդունման ամսաթիվ</td>
                    <td>Ա․Ա․Հ</td>
                    <td>Տարիք</td>
                    <td>Յասցեև հեռախո սահամար</td>
                </tr>

                <tr>
                    <td>{{$inpatient->research}}</td>
                    <td>{{$inpatient->stationary_id}}</td>

                    <td>@if($inpatient->payment=='pp') ԱՅՈ @else Ոչ @endif</td>
                    <td>@if($inpatient->payment=='paid') ԱՅՈ @else Ոչ @endif</td>
                    <td>{{$inpatient->date}}</td>
                    <td>{{$patent->full_name}}</td>
                    {{$patent->birth_date}}
                    <td>{{$patent->birth_date}}</td>
                    <td>{{$patent->m_phone}}</td>
                </tr>


            </table>
            <br>
            <br>
            <br>
            <table>
                <tr>
                    <td>Աշխ․վայրև պաշտոն</td>
                    <td>Ախտորոշում ընդունան պահին</td>
                    <td>Ախտորոշում դուրս գրման պահին</td>
                    <td>Բուժմանձն</td>
                    <td>Դուրսգրման ամսաթիվ</td>
                    <td>Մահճակալ օրերի քանան</td>
                    <td>Բուժման արդյունք</td>
                    <td>Բուժ․բժշկի ստորագրություն</td>
                </tr>
                @foreach($inpatient_diagnos as $k=>$diagnos)
                    <tr>
                        <td>@if($k==0){{$patent->profession}}@endif</td>
                        @if($diagnos->type=='enter')
                            <td>{{$diagnos->diagnos_name->name}}</td>
                            <td></td>
                        @else
                            <td></td>
                            <td>{{$diagnos->diagnosis_comment}}</td>
                        @endif
                        <td>@if($k==0){{$tumorlists->name}}@endif</td>
                        <td>@if($k==0){{$inpatient->date_discharge}}@endif</td>
                        <td>@if($k==0){{$inpatient->bed_id}}- օր{{$inpatient->number_days}}@endif</td>
                        <td>@if($k==0){{$inpatient->treatment_result}}@endif</td>
                        <td>@if($k==0){{ $inpatient->Doctor->full_name ?? ''}}@endif</td>

                    </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>
</body>
</html>


