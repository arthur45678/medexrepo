<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/erythrocyte_morphology.css')}}">
    <title>ԷՐԻՏՐՈՑԻՏՆԵՐԻ ՄՈՐՖՈԼՈԳԻԱ</title>
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
                <div class="text-center"><strong>ԷՐԻՏՐՈՑԻՏՆԵՐԻ ՄՈՐՖՈԼՈԳԻԱ</strong></div>
                <div class="text-center"><strong>Морфология эритроцитов</strong></div>
                <br>
                <div>Անոզիցիտոզ(մակրոցիտոզներ,միկրոցիտներ, մեգալոցիտներ)</div>
                <div>Анозицитоз ( макроцитозы,  микроциты, мегалоциты)</div>
                <p>{{$em->anocytosis_comment}}</p>
                <br>
                <div >Պոյկիլոցիտոզ </div>
                <div>Пойкилоцитоз </div>
                <p>{{$em->poikilocytosis_comment}}</p>
                <br>
                <div >Բազոֆիլ հատիկավորմամբ էրիտրոցիտներ  </div>
                <div>Базофильная зернистость  </div>
                <p>{{$em->basophil_comment}}</p>
                <br>
                <div >Պոլիխրոմատոֆիլիա  </div>
                <div>Полихроматофолия </div>
                <p>{{$em->polychromatophilia_comment}}</p>
                <br>
                <div>Ժոլիի մարմիններ, Կեբոտի օղակներ</div>
                <div>Тельца Жолли, кольца Кебота</div>
                <p>{{$em->jolie_bodies_comment}}</p>
                <br>
                <div >Էրիթրո-նորմոբլաստներ (100 լեյկոցիտի համար) </div>
                <div>Эритро-нормобласты (из 100 лейкоцитов)</div>
                <p>{{$em->erythronormoblasts_comment}}</p>
                <br>
                <div>Մեգալոբլաստներ</div>
                <div >Мегалобласты</div>
                <p>{{$em->mesaloblasts_comment}}</p>
                <br>
                <div>Լեյկոցիտների մորֆոլոգիա</div>
                <br>
                <div >Կորիզների գերսեգմենտացում</div>
                <div>Гиперсегментация ядер</div>
                <p>{{$em->nuclear_over_segmentation_comment}}</p>
                <br>
                <div >Տոքսոգեն հատիկավորում </div>
                <div>Токсогенная зернистость</div>
                <p>{{$em->toxic_fatification_comment}}</p>
                <br>
                <div class="float-left">Անալիզի պատասխանի ամսաթիվ/Дата выдачи анализа</div>
                <div class="float-left bottom-line">{{$em->analysis_response_date}}</div>
                <br><br>
                <div class="float-left">Ստորագրություն/Подпись</div>
                <div class="float-left bottom-line">{{$em->attending_doctor->full_name}}</div>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>
