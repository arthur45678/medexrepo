<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/immunological_examination_pattern_n1.css')}}">
    <title>ԲԺՇԿԱԿԱՆ ՁԵՎ N 1</title>
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
           <div>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
              <p class="text-center"></p>
              <br>
              <div class="text-center">ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</div>
              <br>
              <div class="text-center"> ԲԺՇԿԱԿԱՆ ՁԵՎ N 1</div>
              <br>
               <div class="display-flex">
                   <div>Շճաբանական հետազոտություն N</div>
                   <span class="bottom-line">{{$immunologia->research}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Կենսանյութը վերցնելու ամսաթիվ</div>
                   <span class="bottom-line">{{$immunologia->date}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Ազգանուն, անուն, հայրանուն</div>
                   <span class="bottom-line">{{$patent->full_name}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Տարիք</div>
                   <span class="bottom-line">{{$patent->birth_date}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Բաժանմունք</div>
                   <span class="bottom-line">{{$immunologia->department->name ?? ' '}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Պալատ</div>
                   <span class="bottom-line">{{$immunologia->hospital_room_number}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Ուղեգրող բժշկի անուն, ազգանուն</div>
                   <span class="bottom-line">{{$immunologia->doctor->full_name ?? ' '}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div class="display-flex">
                       <div>Ամբուլատոր բժշկական քարտի N</div>
                       <span class="bottom-line">{{$amboulator->number ?? ' '}}</span>
                   </div>

                   <div class="display-flex" style="margin-left: 25px;">
                       <div>Հիվանդության պատմագրի N</div>
                       <span class="bottom-line">{{$stationarie->number ?? ' '}}</span>
                   </div>
               </div>
              <br><br>
              <div class="text-center"><strong>Շճաբանական հետազոտություն</strong></div>
              <br>
              <div class="display-flex">
                <div><strong> CRP /Ց-ռեակտիվ սպիտակուց մինչև 6 մգ/լ </strong></div>
                <div class="bottom-line">{{$immunologia->CRP}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div><strong> ASO /Հակաստրեպտոլիզին O/ մինչև 20 ՄՄ/մլ </strong></div>
                <div class="bottom-line">{{$immunologia->ASO}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div><strong> RF /Ռևմատոիդ գործոն/ մինչև 8 ՄՄ/մլ</strong></div>
                <div class="bottom-line">{{$immunologia->RF}}</div>
              </div>
              <br>

               <div class="display-flex">
                   <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                   <span class="bottom-line">{{$immunologia->attendingdoctor->full_name ?? ' '}}</span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Ստորագրություն</div>
                   <span class="bottom-line1"></span>
               </div>
               <br>
               <div class="display-flex">
                   <div>Շճաբանական հետազոտության պատասխանի տրման ամսաթիվ</div>
                   <span class="bottom-line">{{$immunologia->date_research}}</span>
               </div>
           </div>
      </div>
   </div>
</body>
</html>
