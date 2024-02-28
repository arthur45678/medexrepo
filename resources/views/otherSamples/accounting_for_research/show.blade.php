<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/accounting_for_research.css')}}">
    <title>ԿԱՏԱՐՎԱԾ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆՆԵՐԻ ՀԱՇՎԱՌՈՒՄ</title>
</head>
<body>
<div class="page-wrap" >
        <div class="main-container">
            <div class="new-page">
                <br><br><br>
                 <div class="table-deg">
                 <div class="display-flex" style="width: 200px;">
                    <div>Ամսաթիվ</div>
                    <span class="bottom-line">{{$accounting->last()->date}}</span>
                 </div>
                 <br>
                    <table class="table">
                        <tr>
                            <td rowspan="3">Բժիշկ</td>
                            <td rowspan="3">Գործողությունը</td>
                            <td colspan="4">ՍՏԱՑԻՈՆԱՐ</td>
                            <td colspan="7">ԱՄԲՈՒԼԱՏՈՐ</td>
                            <td rowspan="3">Ընդամենը</td>

                        </tr>
                        <tr>			
                            <td rowspan="2">Պ/Պ</td>
                            <td rowspan="2">ՎՃ</td>
                            <td rowspan="2">սոց.փ.</td>
                            <td rowspan="2">ս/պ</td>
                            <td rowspan="2">Պ/Պ</td>
                            <td colspan="2">ՎՃ</td>
                            <td colspan="2">ՍՈՑ.Փ.</td>
                            <td colspan="2">Ս/Պ ԳՐՈՒԹՅՈՒՅՈՒՆ</td>

                        </tr>
                        <tr>
                            <td>Ներքին</td>
                            <td>Դրսի</td>
                            <td>Ներքին</td>
                            <td>Դրսի</td>
                            <td>Ներքին</td>
                            <td>Դրսի</td>
                        </tr>

                        @foreach($accounting as $accountings)
                            <tr>
                                <td>{{$accountings->attending_doctor_id}} ????</td>
                                <td>{{$accountings->action}}</td>
                                <td>{{$accountings->stationary_pp}}</td>
                                <td>{{$accountings->stationary_vj}}</td>
                                <td>{{$accountings->social_package}}</td>
                                <td>{{$accountings->stationary_sp}}</td>
                                <td>{{$accountings->ambulator_pp}}</td>
                                <td>{{$accountings->ambulator_internal}}</td>
                                <td>{{$accountings->ambulator_out}}</td>
                                <td>{{$accountings->social_package_internal}}</td>
                                <td>{{$accountings->social_package_out}}</td>
                                <td>{{$accountings->writing_sp_internal}}</td>
                                <td>{{$accountings->writing_sp_out}}</td>
                                @php
                                    $sum =  $accountings->action + $accountings->stationary_pp +
                                            $accountings->stationary_vj + $accountings->social_package +
                                            $accountings->stationary_sp + $accountings->ambulator_pp +
                                            $accountings->ambulator_internal + $accountings->ambulator_out + 
                                            $accountings->social_package_internal + $accountings->social_package_out +
                                            $accountings->writing_sp_internal + $accountings->writing_sp_out ;

                                @endphp
                                <td>
                                    {{$sum}}
                                </td>
                            </tr>
                        @endforeach    

                    </table>
                </div>

            </div>
        </div>
</div>
</body>
</html>