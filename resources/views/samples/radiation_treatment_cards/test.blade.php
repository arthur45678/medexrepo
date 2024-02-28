@extends('layouts.cardBase')


@section('css')
    <link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', '')

<div class="text-center">
    <h3>ՃԱՌԱԳԱՅԹԱՅԻՆ ԲՈՒԺՄԱՆ ՔԱՐՏ</h3>
</div>
@endsection


@section('card-content')

    <div class="container">
        <form class="ajax-submitable" action="{{ route('samples.patients.radiation-treatment-card.store', ['patient'=> $patient]) }}" method="POST">
            @csrf
            <ul class="list-group">
                <li class="list-group-item">

                    <div class="text-center">
                        <h5>ՔԱՐՏ N <span>1</span></h5>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="text-center">
                        <h5>Հ/Պ համար  <span>12</span></h5>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="text-center">
                        <h5>Ամբուլատոր քարտի համար  <span>123</span></h5>
                    </div>
                </li>
                <!-- 2 -->
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">1.</span>
                        Ազգանուն, անուն, հայրանուն՝
                    </strong>
                    <ins class="ml-4">{{$patient->all_names}}</ins>
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">2.</span>
                        Ծննդյան թիվը՝
                    </strong>
                    <ins class="ml-4">{{$patient->birth_date}}</ins>

                    <hr>




                <li class="list-group-item">
                    <label><strong>Սեռ</strong></label>
                    <select name="is_male" class="form-control">
                        <option value="" @if (empty($patient->is_male))
                        selected
                            @endif>նշված չէ</option>
                        <option value="0" @if ($patient->is_male === 0)
                        selected
                            @endif>Կին</option>
                        <option value="1" @if ($patient->is_male === 1)
                        selected
                            @endif>Տղամարդ</option>
                    </select>

                </li>


                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">4.</span>
                        Մշտական բնակավայրը՝ քաղաք, գյուղ
                    </strong>
                    <ins class="ml-4">{{$patient->residence_region}}, {{$patient->town_village}}, {{$patient->street_house}}:</ins>
                    <hr class="hr-dashed">
                    <strong>
                        <span class="badge badge-light mr-1">4.1</span>
                        Հեռախոսահամար՝
                    </strong>
                    <ins class="ml-4">{{$patient->c_phone}}, {{$patient->m_phone}}:</ins>
                </li>


                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">5.ա)</span>
                        Կլինիկական ախտորոշում
                    </strong>

                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="clinical_disease_id"
                                              hidden-name="clinical_disease_id" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="clinical_diagnosis_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">բ)</span>
                        Պաթոմորֆ․ ախտորոշում և համար
                    </strong>

                    <div class="my-2">
                        <x-forms.magic-search class="magic-search ajax" value='' hidden-id="patomorph_disease_id"
                                              hidden-name="patomorph_disease_id" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="patomorph_diagnosis_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">գ)</span>
                        Ուղեկցող հիվանդություններ
                    </strong>

                    <div class="my-2">
                        <x-forms.magic-search name="concomitant_disease_id" class="magic-search ajax" value='' hidden-id="diseasis"
                                              hidden-name="concomitant_disease_id" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="concomitant_diagnosis_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">6․</span>
                        Նախկինում ստատցած բուժումը
                    </strong>
                    <x-forms.text-field type="textarea" name="previously_received_treatment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">ա)</span>
                        Վիրահատություն
                    </strong>

                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="surgery_date" type="date"
                                                value="" label="" />
                        </div>
                    </div>

                    <div class="my-2">
                        <x-forms.magic-search name="surgery_disease_id" class="magic-search ajax" value='' hidden-id="diseasis"
                                              hidden-name="surgery_disease_id" data-catalog-name="diseases" placeholder="ընտրել հիվանդությունը․․․" />
                    </div>
                    <x-forms.text-field type="textarea" name="surgery_diagnosis_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">բ)</span>
                        Քիմիաթերապիա
                    </strong>

                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="chemterapy_date" type="date"
                                                value="" label="" />
                        </div>
                    </div>

                    <x-forms.text-field type="textarea" name="chemterapy_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">գ)</span>
                        Ճառագայթային բուժում
                    </strong>

                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="radiation_treatment_date" type="date"
                                                value="" label="" />
                        </div>
                    </div>

                    <x-forms.text-field type="textarea" name="radiation_treatment_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        Ճառագայթահարված հատվածները
                    </strong>
                    <x-forms.text-field type="textarea" name="radiated_areas" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">7․</span>
                        ՈՒռուցքի տեղակայումը - (ՈՒԱԾ - տեղակայումը, ձևը, չափերը, խորությունը)
                    </strong>

                    <x-forms.text-field type="textarea" name="tumor_placement" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                </li>
              {{--  <li  class="list-group-item">
                    <input type="hidden" name="supplement_doctor_id" value="{{ Auth::user()->id }}">
                </li>--}}


                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել մինչև 7-րդ կետի փոփոխությունները'])

                </li>



            </ul>

            <hr class="my-4">

            <ul class="list-group">
                <li class="list-group-item list-group-item-info">

                    <div class="text-center my-2">
                        <h4>Ճառագայթային բուժման պլանը և ֆիզիկոսի տվյալները</h4>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">8․</span>
                        Կուրսը՝
                    </strong>

                    <div class="form-group form-check">
                        <input name="course_radical_program" type="checkbox" class="form-check-input" id="course_root">
                        <label class="form-check-label" for="course_root">Արմատական ծրագիր</label>
                    </div>
                    <div class="form-group form-check">
                        <input name="course_amoqich" type="checkbox" class="form-check-input" id="course_amoqich">
                        <label class="form-check-label" for="course_amoqich">Ամոքիչ</label>
                    </div>
                    <div class="form-group form-check">
                        <input name="course_auxiliary" type="checkbox" class="form-check-input" id="course_ojandak">
                        <label class="form-check-label" for="course_ojandak">Օժանդակ</label>
                    </div>
                    <div class="form-group form-check">
                        <input name="course_effective" type="checkbox" class="form-check-input" id="course_nerardyunavet">
                        <label class="form-check-label" for="course_effective">Ներարդյունավետ</label>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">9․</span>
                        Դոզավորումը՝
                    </strong>
                    <div class="form-group form-check">
                        <input name="dosage_standart" type="checkbox" class="form-check-input" id="dosage_standart">
                        <label class="form-check-label" for="dosage_standart">Ստանդարտ</label>
                    </div>
                    <div class="form-group form-check">
                        <input name="dosage_mult" type="checkbox" class="form-check-input" id="dosage_mult">
                        <label class="form-check-label" for="dosage_mult">Մուլտ․</label>
                    </div>
                    <div class="form-group form-check">
                        <input name="dosage_escal" type="checkbox" class="form-check-input" id="dosage_escal">
                        <label class="form-check-label" for="dosage_escal">Էսկալ</label>
                    </div>
                    <div class="form-group form-check">
                        <input name="dosage_large" type="checkbox" class="form-check-input" id="dosage_big">
                        <label class="form-check-label" for="dosage_big">խոշոր</label>
                    </div>

                    <label class="form-check-label" for="dosage_description">Այլ</label>
                    <x-forms.text-field type="textarea" name="dosage_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">10․</span>
                        Հիվանդի դիրքը՝
                    </strong>

                    <div class="form-group form-check-inline">
                        <input name="patient_position_on_the_back" type="checkbox" class="form-check-input" id="pationt_position_on_the_back">
                        <label class="form-check-label" for="patient_position_on_the_back">մեջքի վրա</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="patient_position_on_the_abdomen" type="checkbox" class="form-check-input" id="pationt_position_on_the_abdomen">
                        <label class="form-check-label" for="pationt_position_on_the_abdomen">Փորի վրա</label>
                    </div>

                    <label for="" class="form-check-label">Այլ</label>
                    <x-forms.text-field type="textarea" name="patient_position_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">11․</span>
                        ՄՕԴ, ԳՕԴ, Ճառագայթային դաշտերը, անկյունները, ԱՈՒՀ/ԱՄՀ, բլոկներ, սեպեր, ճոճումների արագությունը և քանակը, ժամանակը (յուր․ դաշտի համար), ԺԴԲ, ԿԱԴ, փնջի ելքը սանտիգրեյ/ր
                    </strong>
                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">ա)</span>
                        ԿԹԾ1
                    </strong>

                    <x-forms.text-field type="textarea" name="ktc1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">բ)</span>
                        ԿԹԾ2
                    </strong>

                    <x-forms.text-field type="textarea" name="ktc2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">գ)</span>
                        ԿԹԾ3
                    </strong>

                    <x-forms.text-field type="textarea" name="ktc3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-sm-12 col-md-6">
                            <span class="badge badge-light mr-1">12․</span>
                            <strong>Բժիշկ ֆիզիկոս</strong>
                            <x-forms.magic-search hidden-id="physic_doctor_id" hidden-name="physic_doctor_id"
                                                  placeholder="Ընտրել անեսթեզիստին․․․" class="magic-search ajax" data-list-name="users" />
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <span class="badge badge-light mr-1">13․</span>
                            <strong>Ճառ․ թերապևտ</strong>
                            <x-forms.magic-search hidden-id="radiation_therapevt_doctor_id" hidden-name="radiation_therapevt_doctor_id"
                                                  placeholder="Ընտրել անզգայացման բժիշկին․․․" class="magic-search ajax"
                                                  data-list-name="users" />
                        </div>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել 8-ից 13-րդ կետերի փոփոխությունները'])

                </li>
            </ul>


            <hr class="my-4">

            <ul class="list-group">
                <li class="list-group-item list-group-item-info">

                    <div class="text-center my-2">

                        <h4>15․Ճառագայթահարման օրագիր</h4>
                    </div>
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ճառագայթահարման Ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="radiation_date" type="date"
                                                value="" label="" />
                        </div>
                    </div>
                </li>

                <li class="list-group-item">
                    <strong>
                        Ճառագայթահարվող հատվածը
                    </strong>

                    <x-forms.text-field type="textarea" name="irradiated_area" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        Դաշտի չափերը
                    </strong>

                    <x-forms.text-field type="textarea" name="field_dimensions" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        Ճառագայթահարման տևողությունը
                    </strong>

                    <x-forms.text-field type="textarea" name="field_dimensions" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        ՄՕԴ
                    </strong>

                    <x-forms.text-field type="textarea" name="mod" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        ԳՕԴ
                    </strong>

                    <x-forms.text-field type="textarea" name="god" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

                <li class="list-group-item">
                    <strong>
                        N_ԴԴ
                    </strong>

                    <x-forms.text-field type="textarea" name="N_dd" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />

                </li>

              {{--  <li class="list-group-item list-group-item-info">
                    <input type="hidden" name="supplement_doctor_id" value="{{ Auth::user()->id }}">
                </li>--}}

                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել 15րդ կետի փոփոխությունները'])

            </ul>

            <hr class="my-4">

            <ul>

                <li class="list-group-item list-group-item-info">
                    <div class="text-center my-2">

                        <h4>Եզրափակիչ տվյալներ</h4>
                    </div>
                    <ins class="ml-4"></ins>

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">16.</span>
                        Ճառագ․․ ռեակցիա՝
                    </strong>
                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_no" type="checkbox" class="form-check-input" id="radiation_reaction_no">
                        <label class="form-check-label" for="radiation_reaction_no">չկա</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_location" type="checkbox" class="form-check-input" id="radiation_reaction_local">
                        <label class="form-check-label" for="radiation_reaction_local">տեղ</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_hematologist" type="checkbox" class="form-check-input" id="radiation_reaction_hemolog">
                        <label class="form-check-label" for="radiation_reaction_hemolog">արյունաբան</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_general" type="checkbox" class="form-check-input" id="radiation_reaction_basic">
                        <label class="form-check-label" for="radiation_reaction_basic">ընդհանուր</label>
                    </div>

                    <span class="badge badge-light mr-1">Աստիճանը</span>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="1">
                        <label class="form-check-label" for="radiation_reaction_level">1-ին</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="2">
                        <label class="form-check-label" for="radiation_reaction_level">2-րդ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="3">
                        <label class="form-check-label" for="radiation_reaction_level">3-րդ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="radio_reaction_category" id="radiation_reaction_level" value="4">
                        <label class="form-check-label" for="radiation_reaction_level">4-րդ</label>
                    </div>


                    <x-forms.text-field type="textarea" name="radio_reaction_comment" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                    <ins class="ml-4"></ins>

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">17․</span>
                        Բուժման արդյունքը՝
                    </strong>

                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_full_absorption" type="checkbox" class="form-check-input" id="treatment_result_full_absorption">
                        <label class="form-check-label" for="treatment_result_full_absorption">լրիվ ներծծում</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_small_50_procent" type="checkbox" class="form-check-input" id="treatment_result_high_50_procent">
                        <label class="form-check-label" for="treatment_result_high_50_procent">>50%</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_high_50_procent" type="checkbox" class="form-check-input" id="treatment_result_low_50_procent">
                        <label class="form-check-label" for="treatment_result_low_50_procent"><50%</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="treatment_result_no_result" type="checkbox" class="form-check-input" id="treatment_result_no_result">
                        <label class="form-check-label" for="treatment_result_no_result">առանց արդյունքի</label>
                    </div>
                    <div class="form-group form-check-inline">
                        <input name="radio_reaction_deepening" type="checkbox" class="form-check-input" id="treatment_result_deepening">
                        <label class="form-check-label" for="treatment_result_deepening">խորացում</label>
                    </div>

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">18.</span>
                        Եզրափակիչ տվյալներ
                    </strong>

                    <div class="mt-2">
                        <strong>
                            ԿԹԾ1
                        </strong>

                        <x-forms.text-field type="textarea" name="ktc_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԿԹԾ2
                        </strong>

                        <x-forms.text-field type="textarea" name="ktc_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԿԹԾ3
                        </strong>

                        <x-forms.text-field type="textarea" name="ktc_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ՄՕԴ1
                        </strong>

                        <x-forms.text-field type="textarea" name="mod_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ՄՕԴ2
                        </strong>

                        <x-forms.text-field type="textarea" name="mod_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ՄՕԴ3
                        </strong>

                        <x-forms.text-field type="textarea" name="mod_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԳՕԴ1
                        </strong>

                        <x-forms.text-field type="textarea" name="god_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԳՕԴ2
                        </strong>

                        <x-forms.text-field type="textarea" name="god_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԳՕԴ3
                        </strong>

                        <x-forms.text-field type="textarea" name="god_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԺԴԲ1
                        </strong>

                        <x-forms.text-field type="textarea" name="jdb_1" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԺԴԲ2
                        </strong>

                        <x-forms.text-field type="textarea" name="jdb_2" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                    <div class="mt-2">
                        <strong>
                            ԺԴԲ3
                        </strong>

                        <x-forms.text-field type="textarea" name="jdb_3" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                            value="" label="" />
                    </div>

                </li>

                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">19․</span>
                        Հատուկ նշումներ՝
                    </strong>
                    <x-forms.text-field type="textarea" name="special_notes" placeholder="լրացման ազատ դաշտ․․․" class="mt-2"
                                        value="" label="" />
                </li>

                <li class="list-group-item">
                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-sm-12 col-md-6">

                            <strong>Բուժ․ Բժիշկ</strong>
                            <x-forms.magic-search hidden-id="attending_doctor_id" hidden-name="attending_doctor_id"
                                                  placeholder="Ընտրել անեսթեզիստին․․․" class="magic-search ajax" data-list-name="users" />
                        </div>
                        <div class="col-sm-12 col-md-6">

                            <strong>Բաժնի վարիչ</strong>
                            <x-forms.magic-search hidden-id="department_head_doctor_id" hidden-name="department_head_doctor_id"
                                                  placeholder="Ընտրել անզգայացման բժիշկին․․․" class="magic-search ajax"
                                                  data-list-name="users" />
                        </div>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել 16-ից 19-րդ կետերի փոփոխությունները'])

                </li>
            </ul>

        </form>
    </div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection
