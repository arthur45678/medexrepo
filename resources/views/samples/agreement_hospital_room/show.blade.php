<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/agreement_hospital_room.css')}}">
    <title>ՀԱՄԱՁԱՅԱՆԳԻՐ</title>
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
                <div class="text-center"><strong>ՀԱՄԱՁԱՅԱՆԳԻՐ</strong> </div>
                <br>
                <div class="display-flex">
                    <div class="display-flex">
                        <div>Ք</div>
                        <span class="bottom-line">{{$agreem->recommended}}</span>
                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="display-flex">
                        <div>Ամսաթիվ</div>
                        <span class="bottom-line">{{\Illuminate\Support\Carbon::parse($agreem->date)->format('Y-m-d')}}</span>
                    </div>
                </div>
                <br><br>
                <div class="justify"><span class="bottom-line">{{$patient->full_name}} {{$patient->p_name}}</span>,որը ՀՀ կառավարության 2012թ.
                դեկտեմբերի 27-ի N 1691-Ն որոշման N 1 հավելվածի 2-րդ կետի 6-րդ ենթակետի ուժով հանդիսանում է
                սոցիալական փաթեթի շահառու,իսկ <span class="bottom-line">{{$agreem->company_name}} </span>ընկերության հետ կնքված
                ապահովագրության պայմանագրի ուժով՛ ապահովագրված անձ,ահյսուհետ Կողմ 1,
                և ՀՀ ԱՆ << Վ.Ա. Ֆանարջյան անվան ուռուցքաբանական ազգային կենտրոն >> ՓԲԸ-ն, ի դեմս տնօրեն
                <span class="bottom-line">{{$agreem->Director_Name->full_name ??''}}</span>ի,այսուհետ՛ Կողմ 2,կնքեցի սույն համաձայնագիրը հետևալի
                մասին</div>
                <br>
                <br>
                <br>
                <div style="width: 50%; margin: 0 auto;">
                    <div class="display-flex">
                        <div>1.</div>
                        <div class="justify">Կողմ 1-ը բուժօգնություն ստանալու նպատակով ընդունվել է
                            Կողմ 2-ի <span class="bottom-line">{{$agreem->department->name}}</span>
                            բաժանմունք: Կողմ 1-ի բուժօգնությունը կազմակերպվել է ստացիոնար պայմաններում:
                        </div>
                    </div>
                    <div class="display-flex">
                        <div>2.</div>
                        <div class="justify">Կողմ 1-ը տեղեկացված է ՀՀ կառավարության 2014թ
                            մարտի 27-ի N375-Ն որոշման համաձայն սոցիալական փաթեթի առողջապահական
                             փաթեթից օգտվելու իրավունք ունեցող անձանց համար կնքված առողջության
                             ապահովագրության պայմանագրով իրեն տրամադրվող անվճար հիվանդասենյակի մասին:
                        </div>
                    </div>
                    <div class="display-flex">
                        <div>3.</div>
                        <div class="justify">Կողմ 1-ը կամավոր հրաժարվում է հիվանդանոցային
                             բուժման ընթացքում առողջության ապահովագրության պայմանագրով
                             իրեն տրամադրվող անվճար հիվանդասենյակից:
                        </div>
                    </div>
                    <div class="display-flex">
                        <div>4.</div>
                        <div class="justify">Կողմ 1-ը համաձայն է իր սեփական միջոցների հաշվին
                            վճարել վճարովի հիմունքներով տրամադրվող հիվանդասենյակի դիմաց,ինչես
                            նաև տեղեկացված է նրան, որ իր կողմից վճարված գումարները հատուցման
                            ենթակա չեն ապահովագրական ընկերության կողմից:
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br><br>
                <div class="display-flex">
                    <div>
                        <div class="text-center"> <strong> Կողմ 1</strong></div>
                        <br><br>
                        <div class="bottom-line1">{{$patient->soc_card}}</div>
                        <div class="text-center">Սոցիալական քարտ</div>
                        <br>
                        <br>
                        <div class="bottom-line1">{{$patient->residence_region}}{{$patient->street_house}}</div>
                        <div class="text-center">Հասցե</div>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>
                        <div class="text-center"> <strong> Կողմ 2</strong></div>
                        <br><br>
                        <div class="text-center"> ՀՀ ԱՆ << Վ.Ա. Ֆանարջյան անվան <br>
                            ուռուցքաբանական ազգային կենտրոն >> ՓԲԸ <br> Հասցե՛ ք.Երևան
                            Ֆանարջյան 76
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="display-flex">
                    <div>
                        <div class="bottom-line1"></div>
                        <div class="text-center">Ա.Ա.Հ. Ստորագրություն</div>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div>
                        <div class="bottom-line1">{{$agreem->Director_Name->full_name ??' '}}</div>
                        <div class="text-center">Տնօրեն</div>
                    </div>
                </div>

            </div>
    </div>
</div>
</body>
</html>
