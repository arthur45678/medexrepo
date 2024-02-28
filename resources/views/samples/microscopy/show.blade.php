<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/microscopy.css')}}">
    <title>Մանրադիտություն</title>
</head>
<body>
    <div class="page-wrap">
        <div class="new-page">
           <div class="main-container">
                <br><br>
                <div class="text-center"><strong>Մանրադիտություն / Микроскопия</strong></div>
                <br><br>
                <div>տափակ /плоский</div>
                <p>{{$mic->flat}}</p>
                <br>
                <div>անցողային /переходный</div>
                <p>{{$mic->transient}}</p>
                <br>
                <div>երիկամային /почечный</div>
                <p>{{$mic->renal}}</p>
                <br>
                <div>Լեյկոցիտներ /лейкоциты</div>
                <p>{{$mic->leukocytes}}</p>
                <br>
                <div>Էրիտրոցիտներ /Эритроциты</div>
                <p>{{$mic->erythrocytes}}</p>
                <br>
                <div> Անփոփոխ /неизмененные</div>
                <p>{{$mic->resume}}</p>
                <br>
                <div >Փոփոխված /измененные</div>
                <p>{{$mic->changed}}</p>
                <br>
                <div>Ցիլինդրներ /Цилиндры</div>
                <p>{{$mic->cylinders}}</p>
                <br>
                <div>հիալինային /гиалиновые</div>
                <p>{{$mic->hyaline}}</p>
                <br>
                <div>մոմաձև /восковидные</div>
                <p>{{$mic->candle}}</p>
                <br>
                <div >հատիկավոր /зернистые</div>
                <p>{{$mic->granular}}</p>
                <br>
                <div >էպիթելային /эпителиальные</div>
                <p>{{$mic->epithelial}}</p>
                <br>
                <div >լեյկոցիտար/лейкоцитарные</div>
                <p>{{$mic->leukocyte}}</p>
                <br>
                <div >էլիտրոցիտար / эритроцитарные</div>
                <p>{{$mic->erythrocyte}}</p>
                <br>
                <div>պիգմենտային / пигментные</div>
                <p>{{$mic->pigment}}</p>
                <br>
                <div>Լորձ /Слизь</div>
                <p>{{$mic->mucus}}</p>
                <br>
                <div>Աղ /Соль</div>
                <p>{{$mic->salt}}</p>
                <br>
                <div>Բակտերիաներ / Бактерии</div>
                <p>{{$mic->bacteria}}</p>
                <br><br><br>
                <div class="float-left">Անալիզի պատասխանի ամսաթիվ/Дата выдачи анализа</div> 
                <div class="float-left bottom-line">{{$mic->analisis_date}}</div>
                <br><br><br>
                <div class="float-left " >Ստորագրություն/Подпись</div>
                <div class="float-left bottom-line">{{$mic->attending_doctor->full_name}}</div>
                <br><br>
           </div>
      </div>
   </div>
</body>
</html>