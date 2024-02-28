<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="{{mix('css/print/blood_transfusion_record_book.css')}}">
      <title>Արյան փոխներարկման հաշվառման գրանցամատյան</title>
   </head>
   <body>
      <div class="page-wrap">
         <div class="main-container">
            <div class="new-page">
               <br>
               <div class="text-center"><strong>Արյան փոխներարկման հաշվառման գրանցամատյան</strong></div>
               <br><br>
               <table>
                  <thead>
                     <tr>
                        <th>Հերթական No</th>
                        <th >Հիվանդի ԱԱՀ, տարիք</th>
                        <th>Հիվանդի պատմ. No</th>
                        <th>Հիվանդի հասցե</th>
                        <th>Պարկի No<br>խումբ Rh</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>{{$btrb->id}}</td>
                        <td>{{$patient->full_name}} - {{$patient->age}}</td>
                        <td>{{$lates_stationary->id}}</td>
                        <td>{{$patient->town_village}},{{$patient->street_house}},{{$patient->workplace}}</td>
                        <td>{{$btrb->bag_number}}</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </body>
</html>