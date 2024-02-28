<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/print/clinical_lab_n11.css')}}">
    <title>ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 11</title>
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
              <div>ԲԺՇԿԱԿԱՆ ԿԱԶՄԱԿԵՐՊՈՒԹՅԱՆ ԱՆՎԱՆՈՒՄ ԿԱՄ ԱՆՀԱՏ ՁԵՌՆԱՐԿԱՏԻՐՈՋ ԱՆՈՒՆ, ԱԶԳԱՆՈՒՆ</div>
              <p class="text-center">ՖԱնարջյան բժշկական կենտրոն</p>
              <br>
              <div class="text-center">ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</div>
              <br>
              <div class="text-center">ԲԺՇԿԱԿԱՆ ՁԵՎ N 11</div>
              <br>
              <div class="text-center">ԱՐՅԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ</div>
              <br>
              <div class="float-left">կենսանյութը վերցնելու օր, ամիս, տարի</div>
              <div class="float-left bottom-line">{{$cl->biopsy_date}}</div>
              <br><br>
              <div class="display-flex">
                <div>Ազգանուն, անուն, հայրանուն  </div>
                <div class="bottom-line">{{$patient->full_name}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div> Տարիք </div>
                <div class="bottom-line">{{$patient->age}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div>Բաժանմունք  </div>
                <div class="bottom-line">{{$cl->department->name}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div>Պալատ</div>
                <div class="bottom-line">{{$cl->chamber}}</div>
              </div>

              <br>
              <div class="display-flex">
                <div> Ուղեգրող բժշկի անուն, ազգանուն </div>
                <div class="bottom-line">{{$cl->sender_doctor->full_name}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div> Ամբուլատոր բժշկական քարտի/</div>
                <div class="bottom-line">{{$ambulator_id}}</div>
              </div>
              <br>
              <div class="display-flex">
                <div>Հիվանդության պատմագրի  </div>
                <div class="bottom-line">{{$cl->stationary_id}}</div>
              </div>
              <br><br>
                <table>
                    <tr>
                        <td colspan="3" rowspan="2"></td>
                        <td rowspan="2" class="text-center" valign="top">Արդյունք</td>
                        <td colspan="2" class="text-center">Նորմա</td>
                    </tr>
                        <tr>
                        <td colspan="2" class="text-center">ՍԻ Միավորներ</td>
                    </tr>

                    <tr>
                        <td colspan="3" rowspan="2">Հեմոգլոբին</td>
                        <td rowspan="2">
                            Տ {{$cl->hemoglobin_man}} գ/լ <br>
                            Կ {{$cl->hemoglobin_wooman}} գ/լ
                        </td>
                        <td rowspan="2">
                            Տ 130.0-160.0<br>
                            Կ 120.0-140.0
                        </td>
                        <td rowspan="2">գ/լ</td>
                    </tr>

                        <tr></tr>

                    <tr>
                        <td colspan="3" rowspan="2">Էրիթրոցիտներ</td>
                        <td rowspan="2">A
                            Տ {{$cl->erythrocytes_man}} /լ<br>
                            Կ {{$cl->erythrocytes_wooman}} /լ
                        </td>
                        <td rowspan="2">
                            Տ 4.0-5.0 <br>
                            Կ 3.9-4.7
                        </td>
                        <td rowspan="2" >1012/լ</td>
                    </tr>
                        </tr><tr>


                    <tr>
                        <td colspan="3">Գունային ցուցանիշ</td>
                        <td>
                            {{$cl->color_index}}
                        </td>
                        <td>0.85-1.05</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="3">Արյան մակարդելիության ժամանակը ըստ Սուխարևի</td>
                        <td>
                            {{$cl->blood_coagulation}} րոպե
                        </td>
                        <td>սկիզբը 3 – վերջը 5</td>
                        <td>րոպե</td>
                    </tr>

                    <tr>
                        <td colspan="3">Ռետիկուլոցիտներ</td>
                        <td>
                            {{$cl->reticulocytes}} %
                        </td>
                        <td>2-10</td>
                        <td>%</td>
                    </tr>
                    <tr>
                        <td colspan="3">Թրոմբոցիտներ</td>
                        <td>
                            {{$cl->platelets}} /լ
                        </td>
                        <td>150.0-400.0</td>
                        <td>109/լ</td>
                    </tr>
                        <tr>
                        <td colspan="3">Լեյկոցիտներ</td>
                        <td>
                            {{$cl->leukocytes}} /լ
                        </td>
                        <td>4.0-10.0</td>
                        <td>109/լ</td>
                    </tr>

                    <tr>
                        <td colspan="3">Բլաստներ</td>
                        <td>
                            {{$cl->blasts}} %
                        </td>
                        <td class="text-center"> -</td>
                        <td>%</td>
                    </tr>

                    <tr>
                        <td rowspan="7" valign="top" align="center">Նեյտրոֆիլներ</td>
                        <td colspan="2" rowspan="2">Պրոմիելոցիտներ</td>
                        <td rowspan="2">
                            % {{$cl->promyelocytes}} /լ
                        </td>
                        <td rowspan="2" class="text-center">-</td>
                        <td rowspan="2">% 109/լ</td>
                    </tr>
                    <tr></tr>


                    <tr>
                        <td colspan="2">Միելոցիտներ</td>
                        <td>
                            {{$cl->myelocytes}} -
                        </td>
                        <td class="text-center">-</td>
                        <td>"-"</td>
                    </tr>
                    <tr>

                        <td colspan="2">Մետամիլեոցիտներ</td>
                        <td>
                            {{$cl->metamyelocytes}} -
                        </td>
                        <td class="text-center">-</td>
                        <td> "-"</td>
                    </tr>
                    <tr>
                        <td colspan="2">Ցուպիկակորիզավորներ</td>
                        <td>
                            {{$cl->nozzles}} -
                        </td>
                        <td>1-6</td>
                        <td> "-"</td>
                    </tr>

                    <tr>
                        <td colspan="2">Հատվածակորիզավորներ</td>
                        <td>
                            {{$cl->segmented_stones}} -
                        </td>
                        <td>47-72</td>
                        <td>"-"</td>
                    </tr>
                    <tr></tr>

                    <tr>
                        <td colspan="3">Էոզինոֆիլներ</td>
                        <td>
                            {{$cl->eosinophils}} -
                        </td>
                        <td>0.5-5</td>
                        <td> "-"</td>
                    </tr>
                    <tr>
                        <td colspan="3">Բազոֆիլներ</td>
                        <td>
                            {{$cl->basophils}} -
                        </td>
                        <td>0.1</td>
                        <td> "-"</td>
                    </tr>
                    <tr>
                        <td colspan="3">Լիմֆոցիտներ</td>
                        <td>
                            {{$cl->lymphocytes}} -
                        </td>
                        <td>19-37</td>
                        <td> "-"</td>
                    </tr>
                    <tr>
                        <td colspan="3">Մոնոցիտներ</td>
                        <td>
                            {{$cl->monocytes}} -
                        </td>
                        <td>3-11</td>
                        <td>"-"</td>
                    </tr>
                    <tr>
                        <td colspan="3">Պլազմոցիտներ</td>
                        <td>
                            {{$cl->plasma_cells}} -
                        </td>
                        <td class="text-center">-</td>
                        <td>"-"</td>
                    </tr>
                    <tr>
                        <td colspan="3" rowspan="2">Էրիթրոցիտների նստեցման արագություն /ռեակցիա/ ԷՆԱ</td>
                        <td rowspan="2">
                            Տ {{$cl->erythrocyte_sedimentation_man}} մմ/ժ<br>
                            Կ {{$cl->erythrocyte_sedimentation_man}} մմ/ժ
                        </td>
                        <td rowspan="2">
                            Տ 2-10<br>
                            Կ 2-15
                        </td>
                        <td rowspan="2">մմ/ժ</td>
                    </tr>
                    <tr></tr>
               </table>

                <br><br>

            <div class="new-page">
                <br><br>
                <div class="text-center"><strong>Էրիթրոցիտների ձևաբանություն</strong></div>
                <br>  <br>
                <div>Անիզոցիտոզ (մակրոցիտներ, միկրոցիտներ, մեգալոցիտներ)</div>
                <p>{{$cl->anisocytosis}}</p>
                <br>
                <div>Պոյկիլոցիտոզ</div>
                <p>{{$cl->poikilocytosis}}</p>
                <br>
                <div>Բազոֆիլային հատիկավորմամբ էրիթրոցիտներ </div>
                <p>{{$cl->erythrocytes_with_basophilic}}</p>
                <br>
                <div>Պոլիքրոմատոֆիլիա </div>
                <p>{{$cl->polychromatophilia}}</p>
                <br>
                <div>Ժոլիի մարմիններ, Կեբոտի օղակներ  </div>
                <p>{{$cl->jolies_bodies}}</p>
                <br>
                <div> Էրիթրո-նորմոբլաստներ (100 լեյկոցիտի համար)  </div>
                <p>{{$cl->erythro_normoblasts}}</p>
                <br>
                <div> Մեգալոբլաստներ  </div>
                <p>{{$cl->megaloblasts}}</p>
                <br>
                <div>Լեյկոցիտների ձևաբանություն   </div>
                <p>{{$cl->leukocyte_morphology}}</p>
                <br>
                <div>Կորիզների գերհատվածավորում  </div>
                <p>{{$cl->core_overdose}}</p>
                <br>
                <div>Թունածին հատիկավորում  </div>
                <p>{{$cl->toxic_granulation}}</p>
                <br>
                <div class="display-flex">
                    <div> Հետազոտությունը իրականացնող բժշկի անուն, ազգանուն, </div>
                <div class="bottom-line">{{$cl->attending_doctor->full_name}}</div>
                </div>
                <br>
                <div class="float-left">Հետազոտության պատասխանի տրման օր, ամիս, տարի </div>
                <div class="float-left bottom-line">{{$cl->research_date}}</div>
                <br><br>
                <div class="float-left">Ստորագրություն</div>
                <div class="float-left bottom-line"></div>
              </div>
          </div>
    </div>
  </div>
</body>
</html>
