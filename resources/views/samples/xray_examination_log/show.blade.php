<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/xray_examination_log.css')}}">
    <title>Ռենտգեն հետազոտությունների հաշվառման մատյան</title>
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
             <br><br><br>
               <table>
                    <tr>
                        <th>Բոժող բժիշկ</th>
                        <th>Հետազոտություն</th>
                        <th>Օրգան </th>
                        <th>Տեսակ</th>
                        <th>Գումար</th>
                        <th>Հետ․բժիշկ</th>
                        <th>Նյութ</th>
                        <th>BaSO4</th>
                    </tr>
                    <tr>
                        <td>{{$xray->attending_doctor_id}}</td>
                        <td>{{$xray->research}}</td>
                        <td>{{$xray->organ}}</td>
                        <td>{{$xray->type}}</td>
                        <td>{{$xray->sum}}</td>
                        <td>{{$xray->examining_doctor_id}}</td>
                        <td>{{$xray->material}}</td>
                        <td>{{$xray->baso}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>





               </table>
          </div>
    </div>
  </div>
</body>
</html>
