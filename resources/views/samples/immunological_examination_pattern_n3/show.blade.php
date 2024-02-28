 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/immunological_examination_pattern_n3.css')}}">
    <title>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 3</title>
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
              <div class="text-center"> ԲԺՇԿԱԿԱՆ ՁԵՎ N 3</div>
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
                   <span class="bottom-line">{{$immunologia->departments->name ?? ' '}}</span>
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
                   </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <div class="display-flex">
                       <div>Հիվանդության պատմագրի N</div>
                       <span class="bottom-line">{{$stationarie->number ?? ' '}}</span>
                   </div>

               </div>
              <br><br>
              <div class="text-center">
                <strong>
                  <h4 class="text-center">
                  ՎԻՐՈՒՍԱՅԻՆ ԻՆՖԵԿՑԻԱՆԵՐԻ ՇՃԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ
                  </h4>
                </strong>
              </div>
              <br>
               <div>HAV Ig M հեպատիտ A-ի հակամարմիններ</div>
               <br>
               <p>{{$immunologia->HAV ?? ' '}}</p>
               <br>
               <div>HBsAg հեպատիտ B-ի մակերեսային հակածին</div>
               <br>
               <p>{{$immunologia->HBsAg ?? ' '}}</p>
               <br>
               <div>Aոti HBcAg- հեպատիտ B-ի միջուկային հակամարմիններ</div>
               <br>
               <p>{{$immunologia->aոti_HBcAg_b ?? ' '}}</p>
               <br>
               <div>Aոti HBcAg- Ig M, Ig G հեպատիտ B-ի միջուկային հակամարմիններ</div>
               <br>
               <p>{{$immunologia->aոti_HBcAg_Ig ?? ' '}}</p>
               <br>
               <div>Aոti HBeAg- հեպատիտ B-ի միջուկային հակամարմիններ</div>
               <br>
               <p>{{$immunologia->aոti_HBcAg_Hepatitis_b ?? ' '}}</p>
               <br>
               <div>HCV հեպատիտ C- ի ընդ. հակամարմիններ</div>
               <br>
               <p>{{$immunologia->HCV_Hepatitis_C ?? ' '}}</p>
               <br>
               <div>Aոti HIV 1+2- ՄԻԱՎ-ի հակամարմիններ</div>
               <br>
               <p>{{$immunologia->MIAV ?? ' '}}</p>
               <br>
               <div>EBV Ig M / IgG _Էպշտեյն-Բարրի վիրուս հակամարմիններ</div>
               <br>
               <p>{{$immunologia->EBV ?? ' '}}</p>
               <br>
               <div class="display-flex">
                   <div>Հետազոտությունը կատարվել է</div>
                   <span class="bottom-line">{{$immunologia['research_done'] ?? ' '}}</span>&nbsp;&nbsp;&nbsp;
                   <div>վերլուծիչով</div>
               </div>
               <br>
               <div class="display-flex">
                   <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                   <span class="bottom-line">{{$immunologia->Attending_doctor->full_name ?? ' '}}</span>
               </div>
               <br>
               <br>
               <div class="float-left">Հետազոտության պատասխանի տրման օր, ամիս, տարի </div>
               <div class="float-left bottom-line">{{$immunologia->date_research}}</div>
               <br><br>
               <div class="display-flex">
                   <div>Ստորագրություն</div>
                   <span class="bottom-line1"></span>
               </div>
           </div>
      </div>
   </div>
</body>
</html>
