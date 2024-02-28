<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/lamp_operation_mode.css')}}">
    <title>Բակ լամպի աշխատանքի ռեժիմ</title>
    @isset ($for_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endisset
</head>
<body>

<div class="page-wrap">
        <div class="new-page">
           <div class="main-container">
               <br><br>
               <table >
                   <tr>
                      <td>Ամսաթիվ</td>
                      <td>Անվանում</td>
                      <td>Բակ․լամպի ռեժիմ</td>
                      <td>Բակ․լամպի բացման սկիզբ</td>
                      <td>Բակ․լամպի անջատում </td>
                      <td>Պատասխանատուլ բուժքույր</td>
                   </tr>

               @foreach($lamp as $lamps)
                   <tr>

                      <td>{{$lamps->date}}</td>
                      <td>{{$lamps->title}}</td>
                      <td>{{$lamps->regime}}</td>
                      <td>{{$lamps->opening_start}}</td>
                      <td>{{$lamps->opening_end}}</td>
                       <td>{{$lamps->nurse->full_name}}</td>
                   </tr>
                   @endforeach



               </table>
           </div>
      </div>
   </div>
</body>
</html>
