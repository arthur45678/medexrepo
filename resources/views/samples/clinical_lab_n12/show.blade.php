<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/clinical_lab_n12.css')}}">
    <title>ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 12</title>
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
              <div class="text-center">ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</div>
              <br>
              <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 12</div>
              <br>
              <div class="text-center">ՄԵԶԻ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ </div>
              <br>
              <div class="float-left"> 	կենսանյութը վերցնելու օր, ամիս, տարի</div>
              <div class="float-left bottom-line">{{$cl->biopsy_date}}</div>
              <br><br>
              <div class="display-flex">
                <div> Ազգանուն, անուն, հայրանուն  </div>
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
                <div> Ամբուլատոր բժշկական քարտի/</div>
                <div class="bottom-line">{{$ambulator_id}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div>Հիվանդության պատմագրի  </div>
                <div class="bottom-line">{{$cl->stationary_id}}</div>
              </div>
              <br><br>
              <div class="text-center"><strong>Ֆիզիկաքիմիական հատկություններ</strong></div>
              <br>
              <div >Քանակը</div>
              <div >լ.</div>
              <p>{{$cl->count_l}}</p>
              <div>մլ.</div>
              <p>{{$cl->count_ml}}</p>
              <br>
              <div>Գույնը</div>
              <p>{{$cl->color}}</p>
              <br>
              <div>Թափանցիկությունը</div>
              <p>{{$cl->transparency}}</p>
              <br>
              <div>Հարաբերական խտությունը</div>
              <p>{{$cl->relative_density}}</p>
              <br>
              <div>Ռեակցիա </div>
              <p>{{$cl->reaction}}</p>
              <br>
              <div>Սպիտակուց  </div>
              <div>գ/լ </div>
              <p>{{$cl->protein_gl}}</p>
              <div>գ% </div>
              <p>{{$cl->protein_g}}</p>
              <br>
              <div>Գլյուկոզ </div>
              <div>մմոլ/լ</div>
              <p>{{$cl->glucose_mmol}}</p>
              <div>գ%</div>
              <p>{{$cl->glucose_g}}</p>
              <br>
              <div>Կետոնային մարմիններ</div>
              <p>{{$cl->ketone_bodies}}</p>
              <br>
              <div>Հեմոգլոբին (ռեակցիա-դրական, թույլ, արտահայտված, բացասական)</div>
              <p>{{$cl->hemoglobin}}</p>
              <br>
              <div>Բիլիռուբին </div>
              <p>{{$cl->bilirubin}}</p>
              <br>
              <div>Ուռոբիլինոիդներ </div>
              <p>{{$cl->urobilinoids}}</p>
              <br>
              <div>Լեղաթթուներ </div>
              <p>{{$cl->bile_acids}}</p>
              <br>
              <div>Ինդիկան </div>
              <p>{{$cl->indica}}</p>
          <div class="new-page">

              <div class="text-center"><strong>ՄանրադիտումԷպիթել`</strong></div>
              <br>
              <div>Տափակ </div>
              <p>{{$cl->flat}}</p>
              <br>
              <div>Անցումային </div>
              <p>{{$cl->transitional}}</p>
              <br>
              <div>Երիկամային </div>
              <p>{{$cl->renal}}</p>
              <br>
              <div>Լեյկոցիտներ </div>
              <p>{{$cl->leukocytes}}</p>
              <br>
              <div>Էրիթրոցիտներ </div>
              <p>{{$cl->erythrocytes}}</p>
              <br>
              <div class="float-left" >{{$cl->erythrocytes_bool}}</div>
              <br><br><br>
              <div> <strong>Գլանակներ`</strong> Հիալինային</div>
              <p>{{$cl->hyalina}}</p>
              <br>
              <div>Հատիկավոր</div>
              <p>{{$cl->granular}}</p>
              <br>
              <div>Մոմանման</div>
              <p>{{$cl->wax}}</p>
              <br>
              <div>Էպիթելային</div>
              <p>{{$cl->epithelial}}</p>
              <br>
              <div>Լեյկոցիտար</div>
              <p>{{$cl->leukocyte}}</p>
              <br>
              <div>էրիթրոցիտար</div>
              <p>{{$cl->erythrocytar}}</p>
              <br>
              <div>Պիգմենտային</div>
              <p>{{$cl->pigmented}}</p>
              <br>
              <div><strong>Լորձ</strong></div>
              <p>{{$cl->mucus}}</p>
              <br>
              <div><strong>Աղեր</strong></div>
              <p>{{$cl->salts}}</p>
              <br>
              <p></p>
              <br>
              <div> <strong>Բակտերիաներ</strong></div>
              <p>{{$cl->bacteria}}</p>
              <br>
           <div class="new-page">
                <div class="display-flex">
                    <div> Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն, </div>
                <div class="bottom-line">{{$cl->attending_doctor_id}}</div>
                </div>
                <br>
                <div class="float-left">Հետազոտության պատասխանի տրման օր, ամիս, տարի </div>
                <div class="float-left bottom-line">{{$cl->research_date}}</div>
                <br><br>
                <div class="float-left">Ստորագրություն</div>
                <div class="float-left bottom-line"></div>
              </div>
            </div>
          </div>
    </div>
  </div>
</body>
</html>
