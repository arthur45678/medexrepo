<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/immunological_examination_pattern_n7.css')}}">
    <title>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 7</title>
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
            <div class="text-center"><strong>ԻՄՈՒՆԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 7</strong></div>
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
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <div class="display-flex">
                    <div>Հիվանդության պատմագրի N</div>
                    <span class="bottom-line">{{$stationarie->number ?? ' '}}</span>
                </div>
            </div>
              <br><br>
              <div class="text-center"><strong>ՈՒՌՈՒՑՔԱՅԻՆ ՄԱՐԿԵՐՆԵՐ</strong></div>
              <br>
              <div class="display-flex">
                <div ><strong>  AFP / ալֆա ֆետոպրոտեին/</strong></div>
                <div class="bottom-line">{{$immunologia->AFP ?? ' '}}</div>
                <div><strong>&nbsp; - N – մինչև 10 ՄՄ/մլ </strong></div>
              </div>
              <br>
              <div class="display-flex">
                <div><strong> TPSA / ընդ.պրոստատ սպեցիֆիկ հակածին </strong></div>
                <div class="bottom-line">{{$immunologia->TPSA ?? ' '}}</div>
                <div ><strong>&nbsp; 2,4-4,0նգ/մլ</strong></div>
              </div>
              <br>
              <div class="display-flex">
                <div ><strong>FPSA / ազատ պրոստատ սպեցիֆիկ հակածին/</strong></div>
                <div class="bottom-line">{{$immunologia->FPSA ?? ' '}}</div>
                <div ><strong>&nbsp; 15% TPSA-ից</strong></div>
              </div>
              <br>
              <div class="display-flex">
                <div ><strong>CEA / կարցինոէմբրիոնալ հակածին/</strong></div>
                <div class="bottom-line">{{$immunologia->CEA ?? ' '}}</div>
                <div ><strong>&nbsp;0-5, 0նգ/մլ</strong></div>
              </div>
              <br>
              <div class="display-flex">
                <div ><strong>CA19-9 / կարբոհիդրատ հակածին 19-9/</strong></div>
                <div class="bottom-line">{{$immunologia->CA19 ?? ' '}}</div>
                <div ><strong>&nbsp;մինչև 37 ՄՄ/մլ</strong></div>
              </div>
              <br>
              <div class="display-flex">
                <div><strong>CA15-3 / ուռուցքային հակածին 15-3/</strong></div>
                <div class="bottom-line">{{$immunologia->CA15 ?? ' '}}</div>
                <div><strong>&nbsp; մինչև 27 ՄՄ/մլ</strong></div>
              </div>
              <br>
              <div class="display-flex">
                <div ><strong>CA125 / ուռուցքային հակածին 125/</strong></div>
                <div class="bottom-line">{{$immunologia->CA125 ?? ' '}}</div>
                <div ><strong>&nbsp; մինչև 35 ՄՄ/մլ</strong></div>
              </div>
              <br>
              <div class="display-flex">
                <div ><strong>CA 72-4 / կարբոհիդրատ հակածին 72-4/</strong></div>
                <div class="bottom-line">{{$immunologia->CA72 ?? ' '}}</div>
                <div ><strong>&nbsp;0-4,0 ՄՄ/մլ</strong></div>
             </div>
             <br>
              <div class="display-flex">
                <div><strong>NSE / նեյրոսպեցիֆիկ էնոլազա/</strong></div>
                <div class="bottom-line">{{$immunologia->NSE ?? ' '}}</div>
                <div ><strong>&nbsp; մինչև 13,2 ՄՄ/մլ</strong></div>
             </div>
             <br>
            <div class="display-flex">
                <div ><strong>Cyfra 21-2 / ցիտոկերատինի մասնիկ 21-2/</strong></div>
                <div class="bottom-line">{{$immunologia->Cyfra ?? ' '}}</div>
                <div ><strong>&nbsp;մինչև 3,3 ՄՄ/մլ</strong></div>
             </div>
             <br>
            <div class="display-flex">
                <div ><strong>b-hCG / բետա խորիոնիկ հոնադոթրոպին/</strong></div>
                <div class="bottom-line">{{$immunologia['b-hCG'] ?? ' '}}</div>
                <div ><strong>&nbsp;մինչև 5,0 ՄՄդ/լ</strong></div>
             </div>
             <br>
            <div class="display-flex">
                <div><strong>SCC / տափակբջջային ուռուցքային հակածին/</strong></div>
                <div class="bottom-line">{{$immunologia->SCC ?? ' '}}</div>
                <div><strong>&nbsp;մինչև 2,0 նգ/մլ</strong></div>
             </div>
             <br>
            <div class="display-flex">
                <div><strong>b-2MG / բետա -2միկրոգլոբուլին/</strong></div>
                <div class="bottom-line">{{$immunologia['b-2MG'] ?? ' '}} </div>
                <div><strong>&nbsp; 660-2740 նգ/մլ</strong></div>
             </div>
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
