<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/reference.css')}}">
    <title>ՏԵԴԵԿԱՆՔ </title>
</head>
<body>
     <div class="page-wrap">
        <div class="new-page">
           <div class="main-container">
           <br><br>
           <div class="text-center"><strong>ՀԱՅԱՍՏԱՆԻ ՀԱՆՐԱՊ&ՏՈՒԹՅԱՆ </strong></div>
           <div class="text-center"><strong>ԱՌՈՂՋԱՊԱՀՈէԹՅԱՆ ՆԱԽԱՐԱՐՈՒԹՅՈՒՆ </strong></div>
           <br><br>
           <div class="text-center"><strong>Վ Ա. ՖԱՆԱՐՋՅԱՆԻ ԱՆՎԱՆ</strong></div>
           <div class="text-center"><strong>ՈՒՌՈՒՅՔԱԲԱՆՈՒԹՅԱՆ ԱՁԳԱՅԻՆ </strong></div>
           <div class="text-center"><strong> ԿԵՆՏՐՈՆ ՓԲԸ</strong></div>
           <br><br>
           <div class="text-center"><strong>ՏԵԴԵԿԱՆՔ № <span>{{$ref->id}}</span></strong></div>
           <br>
           <div>Տրվում Է  </div>
           <p>{{$patient->full_name}}</p> 
           <div class="margin-left">(/ազգանուն, անուն, հայրանուն/ ) </div> 
           <br><br>
           <div >որ նա գտնվել է բուժման Ուոուցքաբանության ազգային կենտրոնի </div> 
           <br><br>
           <div class="float-left">ստացիոնարում	 </div> 
           <div class="bottom-line float-left">{{$ref->from_date}}</div>
           <div class="float-left ">  &nbsp; ր-ից մինչև</div> 
           <div class="bottom-line float-left">{{$ref->to_date}}</div>
           <br> <br>
           <p></p> 
           <br>
           <div>վերջնական ախտորոշումը</div>
           <p>{{$ref->reference_diagnosis}}</p> 
           <br>
           <div>Ստացած բուժումը </div>
           <p>{{$ref->treatment}}</p> 
           <br>
           <div >Հիվանդի վիճակը դուրս գրման պահին և բժշկի խորհուրդները</div> 
           <p>{{$ref->doctor_advice}} </p> 
           <br>
           <div class="float-left">Անալիզի պատասխանի ամսաթիվ</div> 
            <div class="float-left bottom-line">{{$ref->date}}</div>
            <br><br><br>
            <div class="float-left ">Գլխավոր բժիշկ</div>
            <div class="float-left bottom-line">{{$ref->chief_doctor->full_name}}</div>
            <br><br>
            <div class="float-left ">Բաժանմունքի վարիչ</div>
            <div class="float-left bottom-line">{{$ref->department_head->full_name}}</div>
            <br><br>
            <div class="float-left ">Բուժող բժիշկ</div>
            <div class="float-left bottom-line">{{$ref->attending_doctor->full_name}}</div>
           </div>
      </div>
   </div> 
</body>
</html>