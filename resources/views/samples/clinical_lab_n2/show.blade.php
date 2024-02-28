<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/clinical_lab_n2.css')}}">
    <title>Document</title>
</head>
<body>
<div class="page-wrap">
        <div class="new-page">
          <div class="main-container">
              <br><br>
              <div>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ </div>
              <p class="text-center">ՖԱնարջյան բժշկական կենտրոն</p>
              <br>
              <div class="text-center">ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</div>
              <br>
              <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 2</div>   
              <br>
              <div class="float-left"> Արյունաբանական հետազոտություն  կենսանյութը վերցնելու օր, ամիս, տարի </div>
              <div class="float-left bottom-line">{{$cl->biopsy_date}}</div>
              <br><br>
              <div class="display-flex">
              <div>Ազգանուն, անուն, հայրանուն </div>
              <div class="bottom-line">{{$patient->full_name}}</div>
              </div>
              <br>
              <div class="display-flex">
              <div> Տարիք </div>
              <div class="bottom-line">{{$patient->age}}</div>
              </div>
              <br>
              <div class="display-flex">
              <div>Բաժանմունք  </div>
              <div class="bottom-line">{{$cl->department->name}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div>Պալատ</div>
                <div class="bottom-line">{{$cl->chamber}}</div>
              </div>
              <br>
              <div class="display-flex">
              <div> Ուղեգրող բժշկի անուն, ազգանուն </div>
              <div class="bottom-line">{{$cl->sender_doctor->full_name}}</div>
              </div>
              <br>
              <div class="display-flex">
              <div> Ամբուլատոր բժշկական քարտի N</div>
              <div class="bottom-line">{{$ambulator_id}}</div>
              </div>
              <br>
              <div class="display-flex">
              <div> հիվանդության պատմագրի  N</div>
              <div class="bottom-line">

                {{$cl->stationary_id}}

              </div>
              </div>
              <br>
              <div><strong>Հեմոգլոբին</strong></div>
              <p>{{$cl->hemoglobin}}</p>
              <br>
              <div><strong>Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)</strong>Էրիթրոցիտների նստեցման արագություն (ԷՆԱ)</div>
              <p>{{$cl->erythrocyte_sedimentation_rate}}</p>
              <br>
              <div><strong>Լեյկոցիտներ</strong></div>
              <p>{{$cl->leukocytes}}</p>
              <br>
              <div class="display-flex">
              <div> Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
              <div class="bottom-line">{{$cl->attending_doctor->full_name}}</div>
              </div> 
              <br> 
              <div class="float-left">Հետազոտության պատասխանի տրման օր, ամիս, տարի </div>
              <div class="float-left bottom-line">{{$cl->research_date}}</div>
              <br><br>
          </div>
    </div>
  </div>         
</body>
</html>