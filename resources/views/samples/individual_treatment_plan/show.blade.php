<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/individual_treatment_plan.css')}}">
    <title>ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ</title>

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
                <div class="text-center"><h4>ԱՆՀԱՏԱԿԱՆ ԲՈՒԺՄԱՆ ՊԼԱՆ <br>ՉԱՐՈՐԱԿ ՆՈՐԱԳՈՅԱՑՈՒԹՅՈՒՆՆԵՐՈՎ ՊԱՑԻԵՆՏԻ</h4></div>
                <br><br>
                <div class="display-flex">
                    <div>ՈւՌՈՒՑՔԱԲԱՆԱԿԱՆ ԽՄԲԻ ՈՐՈՇՄԱՆ ՀԱՄԱՐԸ</div>
                    <span class="bottom-line">{{$indivdual->id}}</span>

                </div>
                <br>
               <div>1.Պացիենտ անհատական տվյալները</div>
               <br>
               <div class="display-flex">
                    <div>1)Ա.Ա.Հ.</div>
                    <span class="bottom-line">{{$patient->full_name}} {{$patient->p_name}}</span>
               </div>
               <br>
               <div class="display-flex">
                    <div>2)Ամսաթիվ</div>
                    <span class="bottom-line">{{\Illuminate\Support\Carbon::parse($indivdual->entry_date)->format('Y-m-d')}}</span>
               </div>
               <br>
               <div>2.Լաբարատոր գործիքային ախտորոշիչ հետազոություներ</div>
               <br>
                <div>2.1 Պացիենտ մոտ առկա իրականացված լաբարատոր գործիքային ախտորոշիչ հետազոություների արդյունքները</div>
                <br>
                <p>{{$indivdual['get_from']}}</p>
                <br>
                <div>2.2 Պլանավորվող լաբարատոր գործիքային ախտորոշիչ հետազոություները</div>
                <br>
                <div>1)Լաբարատոր հետազոտություններ</div>
                <br>
               <p>{{$indivdual_service_laboratory->ServiceLaboratory->name ?? ' '}}</p>
               <p>{{$indivdual_service_laboratory['comment']}}</p>
                <br>
                <div>2)Գործիքային հետազոտություններ</div>
                <br>
                <p>{{$indivdual_service_instrumental->ServiceInstrumental->name ?? ' '}}</p>
                <p>{{$indivdual_service_instrumental['comment']}}</p>
                <br>
                <div>3)Ճառագայթային ախտորոշիչ հետազոտություններ</div>
                <br>
                <p>{{$indivdual_service_radiation->ServiceRadiation->name ?? ' '}}</p>
                <p>{{$indivdual_service_radiation['comment']}}</p>
                <br>
                <div>4)Հյուսվածքաբանական կամ բջջաբանական հետազոտություններ</div>
                <br>
               <p>{{$indivdual_service_histological->ServiceHistological->name ?? ' '}}</p>
               <p>{{$indivdual_service_histological['comment']}}</p>
                <br>
                <div>5)Այլ նշումներ</div>
                <br>
                <p>{{$indivdual['histological_other_comment']}}</p>
                <br>
                <div>3.Բժշկական օգնության և սպասարկման պլանավորվող միջամտություններ</div>
                <br>
                <div>1)Վիրահատական միջամտություններ</div>
                <br>
                <p>{{$indivdual->SurgeryLists->name ?? ' '}}</p>
                <p>{{$indivdual['surgery_comment']}}</p>
                <br>
                <div>2)Քիմիաթերապևտիկ բուժում</div>
                <br>
                <p>{{$indivdual_treatment_chemotherapy->TreatmentLists->name ?? ' '}}</p>
                <p>{{$indivdual_treatment_chemotherapy->treatment_comment}}</p>
                <br>
                <div>3)Ճառագայթային թերապիա</div>
                <br>
               <p>{{$indivdual_treatment_radiation->TreatmentLists->name ?? ' '}}</p>
               <p>{{$indivdual_treatment_radiation->treatment_comment}}</p>
                <br>
                <div>4)Այլ միջամտություններ</div>
                <br>
                <p>{{$indivdual['other_interventions']}}</p>
                <br>
                <div>4.Միջփուլային հսկողություն</div>
                <br>
                <p>{{$indivdual['intermediate_control']}}</p>
                <br>
                <div>4.1Վիրահատական միջամտություններից հետո</div>
                <br>
                <p>{{$indivdual['surgical_after_surgical_comment']}}</p>

                <div class="new-page">
                    <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
                    <br>
                    <p>{{$indivdual->SurgicaltDoctor->full_name ?? ' '}}</p>
                    <p>{{$indivdual['doctor_surgical_comment']}}</p>
                    <br>
                    <div>2)Նշանակումներ</div>
                    <br>
                    @foreach($indivdual_appointments_surgical as $indivdual_appointments_surgicals)


                            <p>{{$indivdual_appointments_surgicals->medicine_name->name ?? ' '}}  &nbsp;&nbsp;&nbsp;&nbsp; {{$indivdual_appointments_surgicals->appointments_comments}}</p>

                    @endforeach
                    <br>
                    <div>3)Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ</div>
                    <br>
                    <p>{{$indivdual['surgical_present_comment']}}</p>
                    <br>
                    <div>4.2Քիմիաթերապևտիկ բուժումից հետո</div>
                    <br>
                    <p>{{$indivdual['after_chemotherapy_comment']}}</p>
                    <br>
                    <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
                    <br>
                    <p>{{$indivdual->ChemotherapyDoctor->full_name ?? ' '}}</p>
                    <p>{{$indivdual['doctor_chemotherapy_comment']}}</p>
                    <br>
                    <div>2)Նշանակումներ</div>
                    <br>
                    @foreach($indivdual_appointments_chemotherapy as $indivdual_appointments_chemotherapys)


                            <p>{{$indivdual_appointments_chemotherapys->medicine_name->name ?? ' '}}  &nbsp;&nbsp;&nbsp;&nbsp; {{$indivdual_appointments_chemotherapys->appointments_comments}}</p>

                    @endforeach
                    <br>
                    <div>3)Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ</div>
                    <br>
                    <p>{{$indivdual['chemotherapy_present_comment']}}</p>
                    <br>
                    <div>4.3Ճառագայթային թերապիայից հետո</div>
                    <br>
                    <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
                    <br>
                    <p> {{$indivdual->RadiationDoctor->full_name ?? ' '}}</p>
                    <p> {{$indivdual['doctor_radiation_comment']}}</p>
                    <br>
                    <div>2)Նշանակումներ ??</div>
                    <br>
                    @foreach($indivdual_appointments_radiation as $indivdual_appointments_radiations)


                            <p>{{$indivdual_appointments_radiations->medicine_name->name ?? ' '}}  &nbsp;&nbsp;&nbsp;&nbsp; {{$indivdual_appointments_radiations->appointments_comments}}</p>
                    @endforeach
                    <br>
                    <div>3)Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբանի մոտ ներկայանալ</div>
                    <br>
                    <p>{{$indivdual['radiation_present_comment']}}</p>
                    <br>
                    <div>4.4 Հատուկ նշումներ</div>
                    <br>
                    <p>{{$indivdual['radiation_other_comment']}}</p>
                    <br>
                    <div>5.Բուժումը ավարտելուց հետո հետագա հսկողությունը</div>
                    <br>
                    <p>{{$indivdual['after_control_comment']}}</p>
                    <br>
                    <div>1)ԱԱՊ բժշկի մոտ ներկայանալ</div>
                    <br>
                    <p>{{$indivdual->ControlDoctor->full_name ?? ' '}}</p>
                    <p>{{$indivdual['doctor_control_comment']}}</p>
                    <br>
                    <div>2)Լաբարատոր գործիքային ախտորոշիչ հետազոություներ</div>
                    <br>
                    <p>{{$indivdual['control_present_comment']}}</p>
                    <br>
                    <div class="display-flex">
                        <div>3.Նշանակումներ</div>
                        @foreach($indivdual_appointments_control as $indivdual_appointments_controls)
                            <span class="bottom-line">{{$indivdual_appointments_controls->medicine_name->name ?? ' '}} &nbsp;&nbsp;&nbsp;&nbsp; {{$indivdual_appointments_controls->appointments_comments}}</span>

                        @endforeach

                    </div>
                    <br>
                    <div class="display-flex">
                        <div>4.Հատուկ նշումներ</div>
                        <span class="bottom-line">{{$indivdual['control_other_comments']}}</span>
                    </div>
                    <br>
                    <div class="display-flex">
                        <div>Անհատական բուժման պլանի կազմելու ամսաթիվր</div>
                        <span class="bottom-line">{{\Illuminate\Support\Carbon::parse($indivdual->treatment_date)->format('Y-m-d')}}</span>
                    </div>
                    <br>
                       <div class="display-flex">
                            <div>Մասնագիտացված կազմակերպության բուժող բժիշկ-ուռուցքաբան</div>
                            <span class="bottom-line">{{$indivdual->OncologistDoctor->full_name ?? ' '}}</span>
                        </div>
                    <br>
                    <div class="display-flex">
                        <div>Վիրաբույժ-ուռուցքաբան</div>
                        <span class="bottom-line">{{$indivdual->SurgeonOncologistDoctor->full_name ?? ' '}}</span>
                    </div>
                    <br>
                    <div class="display-flex">
                        <div>

                            <div class="display-flex">
                                <div>Քիմիաթերապևտ</div>
                                <span class="bottom-line">{{$indivdual->ChemotherapistOncologistDoctor->full_name ?? ' '}}</span>
                            </div>
                            <br>
                            <div class="display-flex">
                                <div>Հյուսվածքաբան</div>
                                <span class="bottom-line">{{$indivdual->HistologistOncologistDoctor->full_name ?? ' '}}</span>
                            </div>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div>
                            <div class="display-flex">
                                    <div>Ճառագայթաբան</div>
                                    <span class="bottom-line">{{$indivdual->RadiologistOncologistDoctor->full_name ?? ' '}}</span>
                            </div>
                            <br>
                            <div class="display-flex">
                                    <div>Ճառագայթային ախտորոշման մասնագետ</div>
                                <span class="bottom-line">{{$indivdual->RadiologistSpecialistDoctor->full_name ?? ' '}}</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>
</body>
</html>
