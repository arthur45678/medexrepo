<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('/css/print/biochemical_labs.css') }}">
    <title>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 9</title>
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
                <br><br>
                <div class="text-center">ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
                <p class="text-center">Բ․Ա.Ֆանարջյանի անվան ուռուցքաբանության ազգային կենտրոն ՓԲԸ</p>

                <div class="text-center">ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</div><br>
                <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 9</span></div>
                <br>
                <div class="text-center"> Արյունաբանական հետազոտություն N <span>{{$bl->bbe_number}}</span></div>
                <br>
                <div class="display-flex">
                    <div>Կենսանյութը վերցնելու ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->biopsy_date}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Անուն, ազգանուն, հայրանուն </div>
                    <div class="bottom-line">{{$patient->f_name}} {{$patient->l_name}} {{$patient->p_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div> Տարիք </div>
                    <div class="bottom-line">{{$patient->age}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Բաժանմունք</div>
                    <div class="bottom-line">{{$bl->department->name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Պալատ</div>
                    <div class="bottom-line">{{$bl->chamber}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Ուղեգրող բժշկի անուն, ազգանուն</div>
                    <div class="bottom-line">{{$bl->attending_doctor->full_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Ամբուլատոր բժշկական քարտի</div>
                    <div class="bottom-line">{{$ambulator_id}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Հիվանդության պատմագրի N</div>
                    <div class="bottom-line">{{$bl->stationary_id}}</div>
                </div>
                <br><br>


                <div class="text-center"><strong>Արյան կենսաքիմիական հետազոտություն</strong> </div>
                <br><br>
                <table>
                    <tr>
                        <td>Ցուցանիշ</td>
                        <td>Արդյունքներ</td>
                        <td>Նորմա</td>
                    </tr>
                    <tr>
                        <td>Ընդհանուր սպիտակուց /TP/</td>
                        <td>{{$bl->total_protein}} <span>գ/լ</span></td>
                        <td>65 – 85 գ/լ</td>
                    </tr>
                    <tr>
                        <td>Ալբումին /ALB/</td>
                        <td>
                            {{$bl->albumin}} <span>գ/լ</span>
                        </td>
                        <td>39-52 գ/լ</td>
                    </tr>
                    <tr>
                        <td>Միզանյութ /UREA/</td>
                        <td>{{$bl->urine}} <span>մմոլ/լ</span></td>
                        <td>2.5 – 7,3 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Կրեատինին /CREA/ Տ./Կ.</td>
                        <td>
                            Տ. {{$bl->creatine_man}} <span>մկմոլ/լ</span><br>
                            Կ.{{$bl->creatine_wooman}} <span>մկմոլ/լ</span>
                        </td>
                        <td>
                            Տ. 66-110 մկմոլ/լ <br>
                            Կ. 44-94 մկմոլ/լ
                        </td>

                    </tr>
                    <tr>
                        <td>Ցիստատին Ց /Cys. C/</td>
                        <td>{{$bl->cystatin}} <span>մգ/լ</span></td>
                        <td>0.54-1.55 մգ/լ</td>
                    </tr>
                    <tr>
                        <td>Միզաթթու /URIC ACID/</td>
                        <td>{{$bl->uric_acid}} <span>մմոլ/լ</span></td>
                        <td>200-420 մկմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Ընդհանուր խոլեստերին /Chol tot/</td>
                        <td>{{$bl->total_cholesterol}} <span> մմոլ/լ</span></td>
                        <td>< 5,2 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Ցածր խտությամբ լիպոպրոտեիդներ/ Chol LDL/</td>
                        <td>
                            {{$bl->low_density_lipoproteins}} <span>մմոլ/լ</span>
                        </td>
                        <td>1,6-4,9 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Բարձր խտությամբ լիպոպրոտեիդներ / Chol HDL/</td>
                        <td>
                            {{$bl->high_density_lipoproteins}} <span>մմոլ/լ</span>
                        </td>
                        <td>0,9-1,82 մմոլ/լ</td>
                    </tr>
                    <tr>
                        <td>Տրիգլիցերիդներ / TRIG/</td>
                        <td>
                            {{$bl->triglycerides}} <span>մմոլ/լ</span>
                        </td>
                        <td>0,45-1,8 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Ընդհանուր բիլիռուբին /Bil-tot/</td>
                        <td>
                            {{$bl->total_bilirubin}} <span>մկմոլ/լ</span>
                        </td>
                        <td>8.55 – 20.5 մկմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>կապված բիլիռուբին /Bil-dir/</td>
                        <td>
                            {{$bl->related_bilirubin}} <span>մկմոլ/լ</span>
                        </td>
                        <td>0 – 5.1 մկմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>ազատ բիլիռուբին</td>
                        <td>
                            {{$bl->free_bilirubin}} <span>մկմոլ/լ</span>
                        </td>
                        <td>8.55 – 15.4 մկմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Գլյուկոզ/GLU/մազանոթ./երակային</td>
                        <td>
                            {{$bl->glucose}} <span> մմոլ/լ</span>
                        </td>
                        <td>3,3-5,5 / 3,5-6.4 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Տրոպոնին Տ</td>
                        <td>
                            {{$bl->troponin}} <span>նգ/մլ</span>
                        </td>
                        <td>մինչև 0,1 նգ/մլ</td>
                    </tr>

                    <tr>
                        <td>Գլիկոլիզացված հեմոգլոբին HbA1C</td>
                        <td>
                            {{$bl->glycosylated_hemoglobin}} <span>%</span>
                        </td>
                        <td>մինչև 6,5 %</td>
                    </tr>

                    <tr>
                        <td>INS- Ինսուլին</td>
                        <td>
                            {{$bl->insulin}} <span>պմ/լ</span>
                        </td>
                        <td>29-172 պմ/լ</td>
                    </tr>

                    <tr>
                        <td>Proins.-Նախաինսուլին</td>
                        <td>
                            {{$bl->pre_insulin}} <span>պմ/լ</span>
                        </td>
                        <td>1-9,4 պմ/լ</td>
                    </tr>

                    <tr>
                        <td>C-Pept. -Ց-պեպտիդ</td>
                        <td>
                            {{$bl->peptide}} <span>նգ/մլ</span>
                        </td>
                        <td>0,5-3,0 նգ/մլ</td>
                    </tr>

                    <tr>
                        <td>Ալֆա ամիլազ /AMYL/</td>
                        <td>
                            {{$bl->alpha_amylase}} <span>մմոլ/լ</span>
                        </td>
                        <td>25-220 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Ուրոամիլազ /UAMYL/</td>
                        <td>
                            {{$bl->uroamylase}} <span>մմոլ/լ</span>
                        </td>
                        <td>10-490 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Լիպազ /LIP/</td>
                        <td>
                            {{$bl->lipase}} <span>մմոլ/լ</span>
                        </td>
                        <td>մինչև190 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Հիմնային ֆոսֆատազ /ALP/</td>
                        <td>
                            {{$bl->basic_phosphatase}} <span>մմոլ/լ</span>
                        </td>
                        <td>30-120 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Թթվային ֆոսֆատազ /ACP/</td>
                        <td>
                            {{$bl->acid_phosphatase}} <span>մմոլ/լ</span>
                        </td>
                        <td>0-6,5 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Գամագլուտամիլտրանսֆերազ /GGT/</td>
                        <td>
                            {{$bl->gammaglutamyltransferase}} <span>մմոլ/լ</span>
                        </td>
                        <td>6-19 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Ասպարտատամինոտրանսֆերազ /AST/</td>
                        <td>
                            {{$bl->aspartateaminotransferase}} <span>մմոլ/լ</span>
                        </td>
                        <td>մինչև 35 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Ալանինատամինոտրանսֆերազ /ALT/</td>
                        <td>
                            {{$bl->alanineaminotransferase}} <span>մմոլ/լ</span>
                        </td>
                        <td>մինչև 40 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Լակտատդեհիդրոգենազ /LDH/</td>
                        <td>
                            {{$bl->lactatedehydrogenase}} <span>մմոլ/լ</span>
                        </td>
                        <td>120-240 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Խոլինէսթերազ /CHOE</td>
                        <td>
                            {{$bl->cholinesterase}} <span>մմոլ/լ</span>
                        </td>
                        <td>5200-12000 մմոլ/լ</td>
                    </tr>

                    <tr>
                        <td>Կրեատինկինազա-ընդհանուր /KK/ Տ./Կ.</td>
                        <td>
                            Տ. {{$bl->creatine_kinase_general_man}} <span>մկմոլ/լ</span><br>
                            Կ. {{$bl->creatine_kinase_general_wooman}} <span>մկմոլ/լ</span>
                        </td>
                        <td>
                            Տ. 60-200 մմոլ/լ <br>
                            Կ. 35-170 մկմոլ/լ
                        </td>

                    </tr>

                    <tr>
                        <td>Կրեատինկինազա-ՄԲ/KK-MB/</td>
                        <td>
                            {{$bl->creatine_kinase}} <span>մմոլ/լ</span>
                        </td>
                        <td>մինչև 25 մմոլ/լ</td>
                    </tr>



                </table>
                <br><br>

                <div class="display-flex">
                    <div>Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն</div>
                    <div class="bottom-line">{{$bl->sender_doctor->full_name}}</div>
                </div>
                <br>
                <div class="display-flex">
                    <div>Արյունաբանական հետազոտության պատասխանի տրման ամսաթիվ</div>
                    <div class="bottom-line">{{$bl->research_date}}</div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
</body>
</html>
