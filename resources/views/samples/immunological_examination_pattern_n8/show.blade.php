<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/immunological_examination_pattern_n8.css')}}">
    <title>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 8</title>
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
            <br>
            <div class="text-center">ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
            <p></p>
            <br><br>
            <div class="text-center"><strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 8</strong></div>
            <br>
            <div class="display-flex">
              <div class="display-flex">
                  <div>Շճաբանական հետազոտություն N</div>
                  <span class="bottom-line">{{$immunologia->research}}</span>
              </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <br>
              <div class="display-flex">
                  <div>Կենսանյութը վերցնելու ամսաթիվ</div>
                  <span class="bottom-line">{{$immunologia->date}}</span>
              </div>
            </div>
            <br>
            <div class="display-flex">
              <div class="display-flex">
                  <div>Ազգանուն, անուն, հայրանուն</div>
                  <span class="bottom-line">{{$patent->full_name}}</span>
              </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <br>
              <div class="display-flex">
                  <div>Տարիք</div>
                  <span class="bottom-line">{{$patent->birth_date}}</span>
              </div>
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
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="display-flex">
                    <div>Հիվանդության պատմագրի N</div>
                    <span class="bottom-line">{{$stationarie->number ?? ' '}}</span>
                </div>
            </div>
              <br><br>
              <div class="text-center"><strong>ՀՈՐՄՈՆՆԵՐԻ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ</strong></div>
              <br>
              <br>
               <div>FSH-ֆոլիկուլ խթանող հորմոն</div>
               <br>
               <p>{{$immunologia->FSH}}</p>
               <br>
               <div>LH-լյուտեինացնող հորմոն</div>
               <br>
               <p>{{$immunologia->LH}}</p>
               <br>
               <div>AMH-հակամյուլերային հորմոն</div>
               <br>
               <p>{{$immunologia->AMH}}</p>
               <br>
               <div>PRL-պրոլակտին</div>
               <br>
               <p>{{$immunologia->PRL}}</p>
               <br>
               <div>E3-էստրիոլ</div>
               <br>
               <p>{{$immunologia->E3}}</p>
               <br>
               <div>PROG-պրոգեստերոն</div>
               <br>
               <p>{{$immunologia->PROG}}</p>
               <br>
               <div>TEST-տեստոստերոն</div>
               <br>
               <p>{{$immunologia->TEST}}</p>
               <br>
               <div>DHEA-դիհիդրոէպիանդրոստերոն</div>
               <br>
               <p>{{$immunologia->DHEA}}</p>
               <br>
               <br>
               <div>DHEA-S դիհիդրոէպիանդրոստերոն սուլֆատ</div>
               <br>
               <p>{{$immunologia['DHEA-S']}}</p>
               <br>
               <div>COR-կորտիզոլ</div>
               <br>
               <p>{{$immunologia->COR}}</p>
               <br>
               <div>ACTG-ադրենոկորտիկոտրոպ հորմոն</div>
               <br>
               <p>{{$immunologia->ACTG}}</p>
               <br>
               <div>HGH – մարդու աճի հորմոն</div>
               <br>
               <p>{{$immunologia->HGH}}</p>
               <br>
             <br>
            <div class="display-flex">
                <div>Հետազոտությունը կատարվել է</div>
                <span class="bottom-line">{{$immunologia['research-was-done'] ?? ' '}}</span>&nbsp;&nbsp;&nbsp;
                <div>վերլուծիչով</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                <span class="bottom-line">{{$immunologia->attendingdoctor->full_name ?? ' '}}</span>
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
