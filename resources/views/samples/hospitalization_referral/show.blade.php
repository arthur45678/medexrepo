<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/cash_entry_order.css')}}">
    <title>ՀԱՅԱՍՏԱՆԻ ՀԱՆՐԱՊԵՏՈՒԹՅԱՆ ԱՌՈՂՋԱՊԱՀՈՒԹՅԱՆ ՆԱԶԱՐԱՐՈՒԹՅՈՒՆ</title>
</head>
<body>
    <div class="page-wrap">
        <div class="new-page">
          <div class="main-container">
          <br><br>
          <div class="float-left text-center " style="font-size:13px" >
          <div >ԱՅԱՍՏԱՆԻ ՀԱՆՐԱՊԵՏՈՒԹՅԱՆ ԱՌՈՂՋԱՊԱՀՈՒԹՅԱՆ  ՆԱԶԱՐԱՐՈՒԹՅՈՒՆ </div>
          <div>Վ. Ա. ՖԱՆԱՐՋՅԱՆԻ ԱՆՎԱՆ</div>
          <div>ՈՒՌՈՒՑՔԱԲԱՆՈՒԹՅԱՆ ԱԶԳԱՅԻՆԿԵՆՏՐՈՆ ՓԲԸ</div>
          </div>
          <div class="float-left  text-center" style='margin-left:77px'>
          <div >Национальный Центр Онкология</div>
          <div>им. В.A.Фанарджяна</div>
          <div>Министерство здравохранения РА </div>
          </div>
          <br><br><br><br><br><br>
          <div class="text-center"><strong>ՀՈՍՊԻՏԱԼԱՑՄԱՆ ՈՒՂԵԳԻՐ </strong></div>
          <div class="text-center"><strong>НАПРАВЛЕНИЕ НА ГОСПИТАЛИЗАЦИЮ </strong></div>
          <br><br>
          <div class="float-left">ամսաթիվը /дата</div>
          <div class="bottom-line float-left">{{$hr->referral_date}}</div>
          <br><br>
          <div class="float-left">Հիվանդ /больной</div>  
          <div class="bottom-line float-left">{{$patient->full_name}} - {{$patient->age}}</div>
          <br><br>
          <div>Ախտորոշում </div>
          <div>диагноз </div>
          <p>{{$hr->diagnosis}}</p>
          <br>
          <div>Բուժ, միջոցառում </div>
          <div>мероприятие </div>
          <p>{{$hr->medical_measure}}</p>
          <br>
          <div class="float-left">Ընդունվեց/поступление </div>
          <div class=" bottom-line float-left"> 
            @if($hr->accept)
                առաջնային/первичное 
              @else
                կրկնակի/вторичное 

            @endif
          </div>
          <br>
          <br>
          <div class="float-left">Բժիշկ/врач</div>
          <div class="bottom-line float-left">{{$hr->user->full_name}}</div>
          <br><br>
          <div class="float-left">Բաժանմունքի վարիչ/зав.отделением</div>
          <div class="bottom-line float-left" >{{$hr->attending_doctor->full_name}}</div>
         
        </div>
    </div>
  </div>   
</body>
</html>