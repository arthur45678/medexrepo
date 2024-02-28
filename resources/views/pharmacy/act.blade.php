<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/pharmacy.css')}}">
    <title>ԴԵՂԵՐԻ ԱԿՏ</title>
</head>
<body>

<div class="page-wrap">
        <div class="new-page">
            <br><br><br><br><br>
            <br><br>
           <div class="main-container">
                <br><br>
                <div class="display-flex">
                    <div class="container text-center">
                        <br>
                        ՀԱՍՏԱՏՈՒՄ ԵՄ <br><br><< Վ.Ա ֆանարջյան անվան <br> Ուռուցքաբանության Ազգային <br> Կենտրոն>>  ՓԲԸ
                        <br><br>
                        <div class="display-flex">
                            <div>Տնօրեն՛</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Ամսաթիվ</div>
                            <span class="bottom-line">{{\Illuminate\Support\Carbon::now()->format('d-m-Y')}}</span>
                        </div>
                    </div>
                    <div class="container1 text-center">
                        <h4>ԱԿՏ</h4>Մենք ներքոստորագյալներս,կազմեցինք սույն ակտը առ այն որ <span class="bottom-line">swwsqqaaqaqaqaq</span> մասին
                        <p></p>
                        <div class="text-center">(բաժանմունքի անվանումը)</div>
                        <br>
                        <div class="font-size10">
                             դեղատնից կենտրոնացված կամ մարդասիրական,նշել առանձին ակտերով ստացել և բաժանմունքի ընթացիկ աշխատանքների համար օգտագործել ենք բժշկական նշանակության նյութեր և պարագաներ,ըստ ներքոհիշյալ ցուցակի
                        </div>
                    </div>
                    <div class="container text-center">
                        <br>
                            ՀԱՍՏԱՏՎԱԾ Է<br><br>ՀՀ առողջապահության նախարարության 03.12.2001թ. <br> N 889 հրամանով<br> << Բժշկական հաստատությունների դեղերի և բժշկական նշանակության այլ ապրանքների ստացման,պահպանման,<br> հաշվառման  և բաշխման կարգի>>
                    </div>
                </div>
                <table>
                    <tr>
                        <td rowspan="2" class="text-center"></td>
                        <td rowspan="2" class="text-center">ԱՆՎԱՆՈՒՄԸ</td>
                        <td rowspan="2" class="text-center">ՉԱՓՄԱՆ ՄԻՎԱՈՐԸ</td>
                        <td rowspan="2" class="text-center">ԳԻՆԸ</td>
                        <td colspan="2" class="text-center">ՄՆԱՑՈՐԴԸ ԱՄՍՎԱ ՍԿԶԲՈՒՄ</td>
                        <td colspan="2" class="text-center">ՄՈՒՏՔ</td>
                        <td colspan="2" class="text-center">ԾԱԽՍ</td>
                        <td colspan="2" class="text-center">ՄՆԱՑՈՐԴԸ ԱՄՍՎԱ ՎԵՐՋՈՒՄ</td>
                    </tr>
                    <tr>
                        <td class="text-center">Քանակը</td>
                        <td class="text-center">Գումար</td>
                        <td class="text-center">Քանակը</td>
                        <td class="text-center">Գումար</td>
                        <td class="text-center">Քանակը</td>
                        <td class="text-center">Գումար</td>
                        <td class="text-center">Քանակը</td>
                        <td class="text-center">Գումար</td>

                    </tr>
                    @foreach($pharmacy as $k=>$pharmacys)
                        <td>{{$pharmacys->id}}</td>
                        <td>{{$pharmacys->medicine_name->name}}</td>
{{--                        <td> {{__('measurement_units.'.$pharmacys->MeasurementUnit->name)}}</td>--}}
                        <td>{{$pharmacys->price}}</td>
                        <td>{{$pharmacys->balance_of_the_month}}</td>
                        <td>{{$pharmacys->balance_of_the_month* $pharmacys->price}}</td>

                        <td>{{$pharmacys->enter}} </td>
                        <td>{{$pharmacys->enter* $pharmacys->price}}</td>


                        <td>{{$pharmacys->cost}} </td>

                        <td>{{$pharmacys->cost* $pharmacys->price}}</td>
                        <td>{{$pharmacys->balance_end_math_count}}</td>



                        <td>{{$pharmacys->balance_end_math_count*$pharmacys->price}}</td>

                        </tr>
                    @endforeach
                </table>
                <br><br>
                <div class="display-flex">
                    <div class="margin-left10">
                        <div class="display-flex margin-left10">
                            <div>Հանձնաժողովի նախագահ</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Գլխավոր բժիշկ</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Դեղատան վարիչ</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Բաժնի վարիչ</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                    </div>
                    <div  class="margin-left10">
                        <div class="display-flex">
                            <div>Գլխավոր բուժքույր</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                        <br>
                        <div class="display-flex">
                            <div>Հաշվապահ</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                    <br>
                        <div class="display-flex">
                            <div>Ավագ բուժքույր</div>
                            <span class="bottom-line">Simonyan Simon</span>
                        </div>
                    </div>
                </div>
           </div>
      </div>
   </div>
</body>
</html>
