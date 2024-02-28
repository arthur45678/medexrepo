<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/conscious_voluntary_consents.css')}}">
    <title>Գիտակցված կամավոր համաձայնություն</title>
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
                <div class="text-center bottom-line">ՀՀ ԱՆ Վ. ֆանարջյան անվան Ուռուցքաբանության Ազգային կենտրոն ՖԲԸ</div>
                <div class="text-center">(կազմակերպության անվանումը)</div>
            <br>
            <div>
                Հաստատված է ՀՀ ԱՆ Վ. ֆանարջյանի անվան <br>  ՈՒԱԿ -ի տնօրենի <span class="bottom-line">{{ $post->admission_date }}</span> Թիվ<span class="bottom-line">2</span> հրամանաով
             </div>
            <br>
            <div class="text-center"><strong>ԳԻՏԱԿՑՎԱԾ ԿԱՄԱՎՈՐ ՀԱՄԱՁԱՅՆՈՒԹՅՈՒՆ</strong> </div>
            <br>
            <div class="text-center">ՀՀ ԱՆ ՈՒԱԿ -ում հետազոտվելու և բուժում ստանալու համար</div>
            <br>
            <div class="text-indent text-justify">
                Ես/մենք <span class="bottom-line">{{ $post->firstName_lastName_patronymic }}</span> (հիվանդի հարազատը ,խնամակալը,օրինական ներկայացուցիչը)
                տեղեկացված եմ/ենք <span class="bottom-line">{{ $post->patient->f_name}} {{$post->patient->l_name}} {{$post->patient->p_name }}</span> հիվանդության ախտորոշման մասին և գիտակցելով բուժման անհրաժեշտությունը, կամավոր տալիս եմ/ենք իմ/մեր համաձայնությունը համապասախան հետազոտություններ իրականացնելու և/կամ բուժում (վիրահատություն, ռադիոթերապիա, քիմիոթերապիա և այլ <span class="bottom-line">վիրահատություն</span> ) անցկացնելու համար և խնդրում եմ/ենք կիրառել այն:
            </div>
            <br>
            <div class="text-indent text-justify">
                Ես/մենք տեղեկացվում  եմ/ենք բուժման հնարավոր ձևերի և տեսակների մասին, նրանց հիմնավորվածության, անհրաժեշտության եղանակի և նախատեսված բուժման սպասվող կամ ակնկալվող արդյունքների մասին:
            </div>
            <br>
            <div class="text-indent text-justify">
                Ես/մենք տեղեկացված եմ/ենք հավանական բարդությունների (այդ թվում մահացու) մասին և տալիս եմ իմ/մեր համաձայնությունը առաջարկված հետազոտությունների և բուժման ակնկալման համար:
            </div>
            <br>
            <div class="text-indent text-justify">
                Ես/մենք տեղեկացված եմ/ենք, որ բուժումը կամ բուժման գործընթացով պայմանավորված բժշկական ծառայությունների և հետազոտություններ մի մասը (վիրահատություն, ռադիոթերապիա, քիմիոթերապիա և այլն) ՀՀ օրենսդրությամբ սահմանված դեպքերում և կարգով կարող է իրականացվել Անվճար,Համավճարի կամ Վճարովի սկզբունքներով (ընդգծել)
            </div>
            <br>
            <div class="text-indent text-justify">Ծանոթ եմ դեղորայքի կանոններին.</div>
            <br>
            <ul>

                <li class="text-justify">Տեղեկացվում եմ/ենք, որ ուղեկցող դեղորայքը`  {{ $post->getDragsName() }} որը առկա է ՈՒԱԿ-ի դեղատանը ստանում եմ անվճար ,որի համար ստորագրում եմ/ենք <span class="bottom-line">Simon Simonyan</span> </li>
                <br>
                <li class="text-justify">Տեղեկացվում եմ/ենք, որ բուժման համար նախատեսված դեղորայքը (քիմիաթերապևտիկ կամ այլ) ստանում եմ/ենք <span class="bottom-line">վճարովի</span> որի համար ստորագրում եմ/ենք <span class="bottom-line">Simonyan Simon</span>  </li>
                <br>
                <li class="text-justify">Տեղեկացված եմ եմ/ենք, որ ՈՒԱԿ դեղատանն անհրաժեշտ դեղորայքի (քիմիաթերապևտիկ կամ այլ ) բացակայության դեպքում վեռջիններիս ձեռքբերումը թույլատրվում է իմ/մեր կողմից, և խնդրում եմ/ենք թույլ տալ կիրառել իմ/մեր կողմից բերված դեղորայքը ,որն առկա չէ ՈՒԱԿ -ի դեղատանը և տեղեկացված եմ/ենք, որ որակի համար ՈՒԱԿ -ը և բուժող բժիշկը պատասխանատվություն չեն կրում, որի համար ստորագրում եմ/ենք <span class="bottom-line">Simonyan Simon</span> </li>
                <br>
                <li class="text-justify">Տեղեկացված եմ/ենք , որ ՈՒԱԿ դեղատանն անհրաժեշտ դեղորայքի (քիմիաթերապևտիկ կամ այլ ) առկայության դեպքում վեռջիններիս ձեռք բերումը իմ/մեր  ցանկությամբ նաև, թույլատրվում է իմ/մեր կողմից  և խնդրում եմ/ենք թույլ տալ կիրառել իմ/մեր կողմից բերված դեղորայքը, որն առկա չէ ՈՒԱԿ -ի դեղատանը և տեղեկացված եմ/ենք, որ որակի համար ՈՒԱԿ -ը և բուժող բժիշկը պատասխանատվություն չեն կրում, որի համար ստորագրում եմ/ենք <span class="bottom-line">Simonyan Simon</span> </li>
            </ul>
            <div class="text-justify">
                Ես թույլ եմ տալիս տեղեկություն տալի իմ հիվանդության բնույթի,  ընթացքի և հնարավոր արդյունքների մասին իմ
            </div>
            <p></p>
            <br>
            <div class="text-indent text-justify">
                Ես/մենք ծանոթացել եմ/ենք սույն կամավոր համաձայնության բոլոր կետերին, որի համար ստորագրում եմ/ենք տալով իմ/մեր գիտակցված և կամավոր համաձայնությունը:
            </div>
            <div class="text-indent text-justify">
                Սույնով հայտնում եմ/ենք համաձայնությունը տրամադրված տեղեկությունների ՀՀ օրենսդրությամբ սահմանված կարգով հավաքագրման մշակման մշակման և ստուգման համար:
            </div>
            <br>
            <div class="display-flex">
                <div>Ամսաթիվ</div>
                <div class="bottom-line">{{ $post->client_confirm_dat }}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Հիվանդի կամ հարազատի (ԱԱՀ)</div>
                <div class="bottom-line">{{ $post->firstName_lastName_patronymic }}</div>
            </div>
            <br>
             <div class="display-flex">
                <div>Բաժանմունքի վարիչ</div>

                 @foreach($post->department_head_doctor()->get() as $item)
                     <div class="bottom-line">{{ $item->f_name }} {{ $item->l_name }} {{ $item->p_name }}</div>
                 @endforeach

            </div>
            <br>
            <div class="display-flex">
                <div>Բուժող բժիշկ</div>
                @foreach($post->doctor()->get() as $item)
                    <div class="bottom-line">{{ $item->f_name }} {{ $item->l_name }} {{ $item->p_name }}</div>
                @endforeach

            </div>
            <br>

    </div>
</div>
</body>
</html>
