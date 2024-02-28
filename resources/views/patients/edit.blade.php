@extends('layouts.cardBase')

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection


@section('card-header')
@section('card-header-classes', '')
<div class="text-center">
    <h3>{{ $patient->all_names }}</h3>
</div>
@endsection


@section('card-content')

<div class="container">
    <form class="ajax-submitable dont-reset" action="{{route('patients.update', ['patient'=> $patient])}}" method="POST">
        @method("PATCH")
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="f_name" label="Անուն" validationType="ajax" value="{{ $patient->f_name }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="l_name" label="Ազգանուն" validationType="ajax" value="{{ $patient->l_name }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="p_name" label="Հայրանուն" validationType="ajax" value="{{ $patient->p_name }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="birth_date" type="date" label="Ծն․ ամսաթիվ" validationType="ajax" value="{{ $patient->birth_date }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="soc_card" type="text" label="Հծհ" validationType="ajax" value="{{ $patient->soc_card }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="email" type="email" label="Էլ․ հասցե" validationType="ajax" value="{{ $patient->email }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <h5>Գրանցման Հասցե</h5>
                <hr class="hr-dashed">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="residence_region" label="Մարզ" validationType="ajax" value="{{ $patient->residence_region }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="town_village" label="Քաղաք/Գյուղ" validationType="ajax" value="{{ $patient->town_village }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="street_house" label="Փողոց/Շենք" validationType="ajax" value="{{ $patient->street_house }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label style="font-weight: bold">Հեռ․ Բջջային</label>
                        <input type="number" class="form-control" name="m_phone" value="{{ $patient->m_phone }}">
                        {{--<x-forms.text-field name="m_phone" label="Հեռ․ Բջջային" validationType="ajax" value="{{ $patient->m_phone }}" />--}}
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label style="font-weight: bold">Հեռ․ Քաղաք</label>
                        <input type="number" class="form-control" name="c_phone" value="{{ $patient->c_phone }}">
                        {{--<x-forms.text-field name="c_phone" label="Հեռ․ Քաղաքային" validationType="ajax" value="{{ $patient->c_phone }}" />--}}
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="nationality" label="Ազգություն" validationType="ajax" value="{{ $patient->nationality }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="citizenship" label="Քաղաքացիություն" validationType="ajax" value="{{ $patient->citizenship }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="blood_group" type="number" min="1" max="4" label="Արյան խումբ" validationType="ajax" value="{{ $patient->blood_group }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label><strong>RH գործոն</strong></label>
                        <select name="rh_factor" class="form-control">
                            <option value="1" @if ($patient->rh_factor)
                                selected
                            @endif>Դրական</option>
                            <option value="0" @if (!$patient->rh_factor)
                                selected
                            @endif>Բացասական</option>
                        </select>
                    </div>
                </div>
            </li>
            {{-- @dump(empty($patient->is_male)) --}}
            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="passport" label="Անձնագիր" validationType="ajax" value="{{ $patient->passport }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
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
                        {{-- <select name="sex" class="form-control">
                            <option value="կին" @if ($patient->sex ==='կին')
                                selected
                            @endif>Կին</option>
                            <option value="տղամարդ" @if ($patient->sex ==='տղամարդ')
                                selected
                            @endif>Տղամարդ</option>
                        </select> --}}
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <h5>Բնակության Հասցե</h5>
                <hr class="hr-dashed">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="residence_region_residence" label="Մարզ" validationType="ajax" value="{{ $patient->residence_region_residence }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="town_village_residence" label="Քաղաք/Գյուղ" validationType="ajax" value="{{ $patient->town_village_residence }}" />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <x-forms.text-field name="street_house_residence" label="Փողոց/Շենք" validationType="ajax" value="{{ $patient->street_house_residence }}" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-4">
                        <strong>Բնակության վայր</strong>
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="living_place_list"
                            hidden-id="living_place_id" hidden-name="living_place_id" placeholder="Ընտրել բնակության վայրը․․․"
                            value='{{old("living_place_id", $patient->living_place_id)}}' />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <strong>Սոցիալ կենցաղային պայմաններ</strong>
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="social_living_condition_list"
                            hidden-id="social_living_condition_id" hidden-name="social_living_condition_id" placeholder="Ընտրել սոցիալ կենցաղային պայմաններ․․․"
                            value='{{old("social_living_condition_id", $patient->social_living_condition_id)}}' />
                    </div>
                    <div class="form-group col-sm-12 col-md-4">
                        <strong>Ամուսնական կարգավիճակ</strong>
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="marital_status_list"
                            hidden-id="marital_status_id" hidden-name="marital_status_id" placeholder="Ընտրել ամուսնական կարգավիճակը․․․"
                            value='{{old("marital_status_id", $patient->marital_status_id)}}' />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row">
                    <div class="form-group col-sm-12 col-md-6">
                        <strong>Աշխատանքային առանձնահատկություններ</strong>
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="working_feature_list"
                            hidden-id="working_feature_id" hidden-name="working_feature_id" placeholder="Ընտրել աշխատանքային առանձնահատկություններ․․․"
                            value='{{old("working_feature_id", $patient->working_feature_id)}}' />
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <strong>Կրթություն</strong>
                        <x-forms.magic-search class="magic-search ajax" data-catalog-name="education_list"
                            hidden-id="education_id" hidden-name="education_id" placeholder="Ընտրել կրթությունը․․․"
                            value='{{old("education_id", $patient->education_id)}}' />
                    </div>
                </div>

                    <label><strong>Արխիվ</strong></label>
                    <select name="archive" class="form-control">
                        <option value="0" @if ($patient->archive === 0)
                        selected @endif>Ոչ</option>
                        <option value="1" @if ($patient->archive === 1)
                        selected @endif>Այո</option>
                    </select>

            </li>

            @include('shared.forms.list_group_item_submit', ['btn_text'=>'Թարմացնել'])
        </ul>
    </form>
</div>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
@endsection
