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
        <form {{--class="ajax-submitable"--}} action="{{ route('samples.patients.radiation-treatment-card.store', ['patient'=> $patient]) }}" method="POST">
            @csrf
            {{--1-7--}}
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
                </li>
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">2.</span>
                        Ծննդյան թիվը՝
                    </strong>
                    <ins class="ml-4">{{$patient->birth_date}}</ins>

                    <hr>

                </li>
                <li class="list-group-item">
                    <label><strong>Սեռ</strong></label>
                    @if($patient->is_male==0)
                        <ins class="ml-4">Իգական</ins>
                    @else
                        <ins class="ml-4">Արական</ins>
                    @endif
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


                @include('shared.forms.list_group_item_submit', ['btn_text'=>'Պահպանել մինչև 7-րդ կետի փոփոխությունները'])

                </li>
            </ul>


        </form>
    </div>
@endsection

@section('javascript')
    <script src="{{ mix('js/jquery.js') }}"></script>
    <script src="{{ mix('js/all.magicsearch.js') }}"></script>

@endsection
