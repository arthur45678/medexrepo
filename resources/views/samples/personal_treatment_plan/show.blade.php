<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/personal_treatment_plan.css')}}">
    <title>Անհատական բուժման պլան</title>
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
            <div class="text-center">
                ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ
                <br>
                ՉԱՐՈՐԱԿ ՆՈՐԱԳՈՅԱՑՈՒԹՅՈՒՆՆԵՐՈՎ ՊԱՑԻԵՆՏԻ
            </div>
            <br>
            {{--                $plan--}}
            <div class="display-flex">
                <div class="text-center">
                    Ուռուցքաբանական խմբի որոշման հերթական համարը
                </div>
                <div class="bottom-line">{{$plan->regular}}</div>
            </div>
            <br>
            <div>1․Պացիենտի անհատական տվյալները</div>
            <div class="display-flex">
                <div>1)Անուն, ազգանուն, հայրանուն</div>
                <div class="bottom-line">{{$patent->full_name}}</div>
            </div>
            <div class="display-flex">
                <div>2)Դիմելու տարեթիվը, ամիսը, ամսաթիվը</div>
                <div class="bottom-line">{{$plan->date_treatment}}</div>
            </div>
            <br>
            <div>2.Լաբորատոր գործիքային ախտորոշիչ հետազոտություններ</div>
            <div>2.1 Պացիենտի մոտ առկա իրականացված լաբորատոր գործիքային ախտորոշիչ հետազոտությունների արդյունքները</div>
            <p>{{$plan->results}}</p>
            <div>2․2 Պլանավորվող լաբորատոր գործիքային ախտորոշիչ հետազոտությունները</div>
            <div>1)Լաբորատոր հետազոտություններ</div>
            <p>{{$plan->laboratory_research}}</p>
            <div>2)Գործիքային հետազոտություններ</div>
            <p>{{$plan->Instrumental_research}}</p>
            <div>3)Ճառագայթային ախտորոշիչ հետազոտություններ</div>
           <p>{{$plan->radiation_research}}</p>
            <div>4)Հյուսվածքաբանական կամ բջջաբանական հետազոտություն</div>
             <p>{{$plan->histological_research}}</p>
            <div>5)Այլ նշումներ</div>
             <p>{{$plan->other_research}}</p><br>
            <div>3․Բժշկական օգնության և սպասարկման պլանավորող միջամտություններ</div>
            <div>1)Վիրահատական միջամտություն</div>
             <p>{{$plan->Surgical_intervention}}</p>
            <div>2)Քիմիաթերապևտիկ բուժում</div>
            <p>{{$plan->chemotherapy_treatment}}</p>
            <div>3)Ճառագայթային թերապիա</div>
             <p>{{$plan->radiation_therapy}}</p>
            <div>Այլ միջամտություններ</div>
            <p> {{$plan->other_interventions}}</p> <br>
            <div>4․Միջփուլային հսկողություն</div>
            <p>{{$plan->intermediate_control}}</p>
            <div>4․1Վիրահատական միջամտությունից հետո</div>
            <p>{{$plan->after_surgery}}</p>
            <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
            <p>{{$plan->aap_surgery}}</p>
            <div>2)Նշանակումներ</div>
            @foreach($surgery as $surgerys)
            <p>{{$surgerys->medicine_name->name??' '}} - {{$surgerys->comment}}</p>
            @endforeach
            <div>3)Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ</div>
            <p>{{$plan->to_introduce}}</p>
            <div>4․2 Քիմիաթերապևտիկ բուժումից հետո</div>
            <p>{{$plan->after_chemotherapy_treatment}}</p>
            <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
            <p>{{$plan->sap_chemotherapy}}</p>
            <div>2)Նշանակումներ</div>
            @foreach($chemotherapy as $chemotherapys)

                    <p>{{$chemotherapys->medicine_name->name??' '}} - {{$chemotherapys->comment}}</p>
            @endforeach
            <div>3)Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ</div>
            <p>{{$plan->to_come_closer}}</p>
            <div>4․3 Ճառագայթային թերապիայից հետո</div>
            <p>{{$plan->after_radiation_therapy}}</p>
            <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
            <p>{{$plan->aap_radiation}}</p>
            <div>2)Նշանակումներ</div>
            @foreach($radiation as $radiations)

                    <p>{{$radiations->medicine_name->name??' '}} - {{$radiations->comment}}</p>

            @endforeach
            <div>3)Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ</div>
            <p>{{$plan->doctor_oncologist_radiation}}</p>
            <div>4․4 Հատուկ նշումներ</div>
            <p>{{$plan->special_note}}</p> <br>
            <div>5 Բուժումը ավարտելուց հետո հետագա հսկողությունը</div>
            <p>{{$plan->further_control}}</p>
            <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
            <p>{{$plan->aap_control}}</p>
            <div>2)Լաբորատոր գործիքային ախտորոշիչ հետազոտություններ</div>
            <p>{{$plan->diagnostic_tests}}</p>
            <div>3)Նշանակումներ</div>
            @foreach($diagnostic as $diagnostics)

                    <p>{{$diagnostics->medicine_name->name??' '}} - {{$diagnostics->comment}}</p>


            @endforeach
            <div>4)Հատուկ նշումներ</div>
            <p>{{$plan->special_notes}}</p>
            <br>
            <div class="display-flex">
                <div>Անհատական բուժման պլանի կազմելու <br>տարեթիվը, ամիս ամսաթիվ</div>
                <div class="bottom-line">{{$plan['date_treatment']?? ' '}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>Մասնագիտացված կազմակերպության բուժող <br>բժիշկ ուռուցքաբան</div>
                <div class="bottom-line">{{$plan->oncologist->full_name?? ' '}}</div>

            </div>
            <br>
            <div class="display-flex">
                <div>1)Վիրաբույժ-ուռուցքաբան</div>
                <div class="bottom-line">{{$plan->surgeon->full_name?? ' '}}</div>

            </div>
            <br>
            <div class="display-flex">
                <div>2)Քիմիաթերապևտ</div>
                <div class="bottom-line">{{$plan->Chemotherapist->full_name?? ' '}}</div>

            </div>
            <br>
            <div class="display-flex">
                <div>3)Հյուսվածքաբան</div>
                <div class="bottom-line">{{$plan->Histologist->full_name?? ' '}}</div>

            </div>
            <br>
            <div class="display-flex">
                <div>4)Ճառագայթաբան</div>
                <div class="bottom-line">{{$plan->Radiologist->full_name?? ' '}}</div>
            </div>
            <br>
            <div class="display-flex">
                <div>5)Ճաառագայթային ախտորոշման մասնագետ</div>
                <div class="bottom-line">{{$plan->Specialist->full_name?? ' '}}</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
