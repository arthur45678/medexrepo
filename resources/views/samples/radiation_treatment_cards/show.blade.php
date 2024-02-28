<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/print/radiation_treatment_cart.css')}}">
    <title>ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ</title>
    @php
        $is_pdf = $for_pdf ?? false;
    @endphp
    @if ($is_pdf)
        <style>
            *{ font-family: DejaVu Sans !important;}
        </style>
    @endif
</head>
<body>
@php
    $treatment_plan = $card->treatment_plan;
    $treatment_notes = $card->treatment_notes;
    $treatment_final_data = $card->treatment_final_data;

@endphp
<div class="page-wrap">
    <div class=new-page>
        <div class="main-container">
            <br>
            <div class="text-center">ՀՀ Վ․ Ա․ ՖԱՆԱՐԱՋՅԱՆԻ անվ․ ՈՒՌՈՒՂՔԱԲԱՆՈՒԹՅԱՆ ԱԶԳԱՅԻՆ ԿԵՆՏՐՈՆ</div>
            <br>
            <div class="text-center">ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ N <span>{{ $card->id }}</span></div>
            <br><br>
            <div class="float-left">Հ/Պ N</div>
            <div class="bottom-line float-left">4454654</div>
{{--            <div class="float-left margin-left">Ամբ․ քարտ N</div>
            <div class="bottom-line float-left">6546546</div>--}}
            <br><br>
            <div class="float-left">1. Ա․Ա․Հ </div>
            <div class="bottom-line float-left">{{$patient->all_names}}</div>
            <div class="float-left margin-left">2․Տարիքը</div>
            <div class="bottom-line float-left">{{$patient->birth_date}}</div>
            <br><br>
            <div class="float-left">3.Սեռը</div>
            @if($patient->is_male==0)
                <ins class="ml-4">Իգական</ins>
            @else
                <ins class="ml-4">Արական</ins>
            @endif

            <div class="float-left margin-left">4․Հասցե</div>
            <div class="bottom-line float-left">46</div>
            <br><br><br>
            <div>5․ա)Կլինիկական ախտորոշումը</div>
            <p>{{ $card->clinical_disease->name }}</p>

            <br>
            <div>բ)Պաթոմորֆ․ ախտորոշումը և N </div>
            <p>{{ $card->patomorph_disease->name }}</p>
            <br>
{{--            <div>գ)ՈՒղեկցվող հիվանդություններ</div>
            <p></p>
            <br>--}}
          {{--  <div>6․Նախկինում ստացած բուժումը</div>
            <p></p>--}}
            <br>
            <div>ա)Վիրահատություն</div>
            <p>{{ isset($card->surgery_disease) ?? $card->surgery_disease->name }}</p>
            <p></p>
            <br>
            <div>բ)Քիմիաթերապիա</div>
            <p>{{ $card->chemterapy_comment }}</p>
            <br>
            <div>գ)Ճառագայթային բուժում</div>
            <p>{{ $card->radiated_areas }}</p>
            <br>
            Ճառագայթահարված հատվածները, ՄՕԴ, ԳՕԴ, ԺԴԲ
            <br>
            <div>7.ՈՒռուցքի տեղակայումը - (ՈՒԱԾ - տեղակայումը, ձևը, չափերը, խորությունը)</div>
            <p>{{ $card->tumor_placement }}</p>
            <br><br>
            <div class="text-center"><strong>Ճառագայթային բուժման պլանը և ֆիզիկոսի տվյալները</strong></div>
            <br>
            <div class="float-left">8․Կուրսը՝</div>
            <div class="bottom-line float-left">Արմատական</div>
            <p>{{ $treatment_plan->course_radical_program ?? '' }}</p>
            <br><br>
            <div class="float-left">9․Դոզավորումը՝</div>
            @if(isset($treatment_plan->dosage_standart))
                <div class="bottom-line float-left"> </div>
            @endif
            <div class="bottom-line float-left"> {{ $treatment_plan->dosage_standart ?? '' }}</div>

            @if(isset($treatment_plan->dosage_mult))
                <div class="bottom-line float-left"> </div>
            @endif
            <div class="bottom-line float-left"> {{ $treatment_plan->dosage_mult ?? ''}}</div>
            @if(isset($treatment_plan->dosage_escal))
                <div class="bottom-line float-left"> </div>
            @endif
            <div class="bottom-line float-left"> {{ $treatment_plan->dosage_escal ?? ''}}</div>
            @if(isset($treatment_plan->dosage_standart))
                <div class="bottom-line float-left"> </div>
            @endif
            <div class="bottom-line float-left"> {{ $treatment_plan->dosage_standart ?? '' }}</div>
            @if(isset($treatment_plan->dosage_large))
                <div class="bottom-line float-left"> </div>
            @endif
            <div class="bottom-line float-left"> {{ $treatment_plan->dosage_large ?? '' }}</div>

            <br>
            <p></p>
            <br>
            <div class="float-left">10․Հիվանդի դիրքը՝</div>


            <div class="bottom-line float-left">{{ $treatment_plan->patient_position_comment ?? '' }}</div>
            <br>
            <p></p>
            <br>
            <div class="float-left">11․ՄՕԴ, ԳՕԴ, Ճառագայթային դաշտերը, անկյունները, ԱՈՒՀ/ԱՄՀ, բլոկներ, սեպեր, ճոճումների արագությունը և քանակը, ժամանակը (յուր․ դաշտի համար), ԺԴԲ, ԿԱԴ, փնջի ելքը սանտիգրեյ/ր</div>
            <br><br>
            <p></p>
            <br>
            <div>ա)ԿԹԾ1</div>
            <p>{{ $treatment_plan->ktc1 ?? '' }}</p>
            <br>
            <div>բ)ԿԹԾ2</div>
            <p>{{ $treatment_plan->ktc2 ?? '' }}</p>
            <br>
            <div>գ)ԿԹԾ3</div>
            <p>{{ $treatment_plan->ktc3 ?? '' }}</p>
            <br><br>
            <div class="float-left">12․Բժիշկ ֆիզիկոս</div>
            <div class="bottom-line float-left">{{ isset($treatment_plan->physic_doctor) ?? $treatment_plan->physic_doctor->f_name .' '.$treatment_plan->physic_doctor->l_name }}</div>
            <br><br>
            <div class="float-left">13․Ճառ․ թերապևտ</div>
            <div class="bottom-line float-left">{{isset($treatment_plan->radiation_therapevt_doctor) ?? $treatment_plan->radiation_therapevt_doctor->f_name .' '.$treatment_plan->radiation_therapevt_doctor->l_name }}</div>
            <br><br>
           {{-- <div>14․Ուղեկցվող բուժումը</div>
            <p></p>--}}
            <br><br><br>
            <div><strong>15.Ճառագայթահարման օրագիր</strong> </div>
            <br>
            <table>
                <tr>
                    <td>Ճառ․ ա/թ, ժամը</td>
                    <td>Ճառ․ հատվածը</td>
                    <td>Դաշտի չափերը</td>
                    <td>Ճառ․ տևողությունը</td>
                    <td>ՄՕԴ</td>
                    <td>ԳՕԴ</td>
                    <td>N_ԴԴ</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <br><br>
            <div class="float-left">16․Ճառագ․ ռեակցիա՝</div>
            <div class="bottom-line float-left">{{ $treatment_final_data && $treatment_final_data->radio_reaction_no == 0 ? 'Չկա' : 'կա' }}</div>
            <br><br>
            <div class="float-left">Աստիճանը՝</div>//radio_reaction_category
            <div class="bottom-line float-left">{{ $treatment_final_data && $treatment_final_data->radio_reaction_categoryo  }}-ին</div>
            <br><br><br>
            <div class="float-left">17․Ճառագ․ ռեակցիա՝</div>
            <div class="bottom-line float-left">{{ $treatment_final_data && $treatment_final_data->radio_reaction_general }}</div>
            <br><br>
            <div>18.Եզրափակիչ տվյալներ</div>
            <br>
            <div>ԿԹԾ1</div>
            <p>{{ $treatment_final_data->ktc_1 ?? '' }}</p>
            <br>
            <div>ԿԹԾ2</div>
            <p>{{ $treatment_final_data->ktc_2 ?? '' }}</p>
            <br>
            <div>ԿԹԾ3</div>
            <p>{{ $treatment_final_data->ktc_3 ?? '' }}</p>
            <br>
            <div>ՄՕԴ1</div>
            <p>{{ $treatment_final_data->mod_1 ?? '' }}</p>
            <br>
            <div>ՄՕԴ2</div>
            <p>{{ $treatment_final_data->mod_2 ?? '' }}</p>
            <br>
            <div>ՄՕԴ3</div>
            <p>{{ $treatment_final_data->mod_3 ?? '' }}</p>
            <br>
            <div>ԳՕԴ1</div>
            <p>{{ $treatment_final_data->god_1 ?? '' }}</p>
            <br>
            <div>ԳՕԴ2</div>
            <p>{{ $treatment_final_data->god_2 ?? '' }}</p>
            <br>
            <div>ԳՕԴ3</div>
            <p>{{ $treatment_final_data->god_3 ?? '' }}</p>
            <br>
            <div>ԺԴԲ1</div>
            <p>{{ $treatment_final_data->jdb_1 ?? '' }}</p>
            <br>
            <div>ԺԴԲ2</div>
            <p>{{ $treatment_final_data->jdb_2 ?? '' }}</p>
            <br>
            <div>ԺԴԲ3</div>
            <p>{{ $treatment_final_data->jdb_3 ?? '' }}</p>
            <br><br>
            <div>19.Հատուկ նշումներ</div>
            <p>{{ $treatment_final_data->special_notes ?? '' }}</p>
            <br><br>
            <div class="float-left">Բուժող բժիշկ</div>
            <div class="bottom-line float-left">{{ isset($treatment_final_data->attending_doctor) ?? $treatment_final_data->attending_doctor->f_name  }}&nbsp;{{ isset($treatment_final_data->attending_doctor) ?? $treatment_final_data->attending_doctor->l_name  }}</div>
            <br><br>
            <div class="float-left">Բաժնի վարիչ</div>
            <div class="bottom-line float-left">{{ isset($treatment_final_data->department_head_doctor) ?? $treatment_final_data->department_head_doctor->f_name }}&nbsp;{{ isset($treatment_final_data->department_head_doctor) ?? $treatment_final_data->department_head_doctor->l_name }}</div>
            <br><br>

            <br><br><br>
        </div>
    </div>
</div>
</body>
</html>
