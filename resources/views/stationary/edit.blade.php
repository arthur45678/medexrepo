@extends('layouts.cardBase')

@php
# route for


$route = route("patients.stationary.show", ["patient" => $patient, "stationary" => $stationary]);

$mse_intolerance = $user->stationary_medicine_side_effects_groupped[App\Enums\StationaryMedicineSideEffectEnum::intolerance()->getValue()] ?? false;
// $mse_allergy = $user->stationary_medicine_side_effects_groupped[App\Enums\StationaryMedicineSideEffectEnum::allergy()->getValue()] ?? false;

$sd_admission = $user->stationary_diagnoses_groupped[App\Enums\StationaryDiagnosisEnum::admission()->getValue()] ?? false;
$sd_referring_institution = $user->stationary_diagnoses_groupped[App\Enums\StationaryDiagnosisEnum::referring_institution()->getValue()] ?? false;
$sd_clinical = $user->stationary_diagnoses_groupped[App\Enums\StationaryDiagnosisEnum::clinical()->getValue()] ?? false;
$sd_final_clinical = $user->stationary_diagnoses_groupped[App\Enums\StationaryDiagnosisEnum::final_clinical()->getValue()] ?? false;
$sd_disease_complication = $user->stationary_diagnoses_groupped[App\Enums\StationaryDiagnosisEnum::disease_complication()->getValue()] ?? false;
$sd_concomitant_disease = $user->stationary_diagnoses_groupped[App\Enums\StationaryDiagnosisEnum::concomitant_disease()->getValue()] ?? false;
$sd_tuberculosis_complaint = $user->stationary_diagnoses_groupped[App\Enums\StationaryDiagnosisEnum::tuberculosis_complaint()->getValue()] ?? false;

$stationary_surgeries = $user->stationary_surgeries_groupped[App\Enums\StationarySurgeryEnum::stationary()->getValue()] ?? false;
$stationary_disability_certificates = $user->stationary_disability_certificates;
$stationary_expertise_conclusions = $user->stationary_expertise_conclusions;
$stationary_histological_examinations = $user->stationary_histological_examinations;
$stationary_treatments = $user->stationary_treatments;
// dd($stationary_treatments);

$update_diagnosis = route('patients.stationary.update_diagnosis',  ["patient" => $patient, "stationary" => $stationary]);
$delete_reset_diagnoses = route('patients.stationary.delete_reset_diagnoses', ["stationary" => $stationary]);
$create_many_diagnoses = route('patients.stationary.create_many_diagnoses',  ["patient" => $patient, "stationary" => $stationary]);

$create_surgery = route('patients.stationary.create_surgery', ["patient" => $patient, "stationary" => $stationary]);

$create_other_treatment = route('patients.stationary.create_other_treatment', ["patient" => $patient, "stationary" => $stationary]);
$create_many_medicine_side_effects = route('patients.stationary.create_many_medicine_side_effects', ["patient" => $patient, "stationary" => $stationary]);
$create_histological_examination = route('patients.stationary.create_histological_examination', ["patient" => $patient, "stationary" => $stationary]);
$create_disability_certificate = route('patients.stationary.create_disability_certificate', ["patient" => $patient, "stationary" => $stationary]);
$create_expertise_conclusion =  route('patients.stationary.create_expertise_conclusion', ["patient" => $patient, "stationary" => $stationary]);
@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h5>Ստացիոնար հիվանդի</h5>
<h3>Բժշկական քարտ № <span>{{$stationary->number}}</span></h3>
@endsection

@section('card-content')
<div class="container">

        {{-- <button type="button" class="btn btn-lg btn-primary"
            style="position: fixed; bottom:20px; right:20px; z-index: 10;">
            <x-svg icon="cui-file" />
        </button> --}}


        {{-- section needs
        1) $route
        2) $primary_diagnosis
        3) $update_diagnosis_route
        4) $delete_reset_diagnoses_route
        --}}
        @include('stationary.stationary_primary_diagnosis', [
            'route' => $route,
            'primary_diagnosis' => $primary_diagnosis,
            'update_diagnosis' => $update_diagnosis,
            'delete_reset_diagnoses' => $delete_reset_diagnoses
        ])

        {{-- section needs
        1) $route
        2) $mse_intolerance
        3) $create_many_medicine_side_effects
        4) $repeatables
        --}}
        <hr class="my-2">
        @include('stationary.medicine_side_effects_intolerance', [
            'route' => $route,
            'mse_intolerance' => $mse_intolerance,
            'create_many_medicine_side_effects' => $create_many_medicine_side_effects,
            'repeatables' => $repeatables
        ])

        <hr class="my-2">
        <form action="{{route('patients.stationary.update', ["patient" => $patient, "stationary" => $stationary])}}"
            method="POST" class="ajax-submitable -off dont-reset">
            @method('PATCH')
            @csrf
            <ul class="list-group text-center">
                <li class="list-group-item">
                    <div class="container">
                        <div class="form-row align-items-center">
                            <div class="col-md-6">
                                <strong>Փուլը՝</strong>
                                <select name="stage" class="form-control ml-2">
                                    <option value="">Ընտրել փուլը․․․</option>
                                    @foreach ($stage_list as $item)
                                    <option value="{{$item['name']}}" @if (old('stage', $stationary->stage)===$item['name'])
                                        selected='selected'
                                        @endif
                                        >{{$item['name']}}</option>
                                    @endforeach
                                </select>
                                @error('stage')
                                <em class="error text-danger">{{$message}}</em>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mt-2 px-3">
                            <div class="col-md-4">
                                <strong>T<em> - (0,1,2,3,4)</em></strong>
                                <select class="form-control" name="T">
                                    <option value="">ընտրել T-ն</option>
                                    @for ($i = 0; $i < 5; $i++)
                                    <option value="{{$i}}" {{old('T', $stationary->T) === "$i" ? 'selected' : ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <strong>N<em> - (0,1,2,3,x)</em></strong>
                                <select class="form-control" name="N">
                                    <option value="">ընտրել N-ը</option>
                                    @for ($i = 0; $i < 5; $i++)
                                    @if ($i !== 4)
                                        <option value="{{$i}}" {{old('N', $stationary->N) === "$i" ? 'selected' : ''}}>{{$i}}</option>
                                    @else
                                        <option value="x" {{old('N', $stationary->N) === 'x' ? 'selected' : ''}}>x</option>
                                    @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <strong>M<em> - (0,1,x)</em></strong>
                                <select class="form-control" name="M">
                                    <option value="">ընտրել M-ը</option>
                                    @for ($i = 0; $i < 3; $i++)
                                    @if ($i !== 2)
                                        <option value="{{$i}}" {{old('M', $stationary->M) === "$i" ? 'selected' : ''}}>{{$i}}</option>
                                    @else
                                        <option value="x" {{old('M', $stationary->M) === 'x' ? 'selected' : ''}}>x</option>
                                    @endif
                                    @endfor
                                </select>
                            </div>
                        </div>

                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center justify-content-center">
                        <div class="col-md-3">
                            <strong>Արյան խումբ՝</strong>
                        </div>
                        <div class="col-md-3">
                            @if ($patient->blood_group) <em>{{$patient->blood_group_letter}}</em>
                            @else <em>--/--</em> @endif
                        </div>
                    </div>
                    <div class="form-row align-items-center justify-content-center">
                        <div class="col-md-3">
                            <strong>Rh-գործոն՝</strong>
                        </div>
                        <div class="col-md-3">
                            @if ($patient->rh_factor_sign) <em class="h5">{{$patient->rh_factor_sign}}</em>
                            @else <em>--/--</em> @endif
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center justify-content-center">
                        <div class="col-md-3">
                            <strong>Բուժող բժիշկ՝</strong>
                        </div>
                        <div class="col-md-3">
                            @if($stationary->attending_doctor_id)

                            <em class="h5">{{$stationary->attending_doctor->full_name}}</em>
                            @else <em>_____________</em> @endif
                        </div>
                    </div>
                </li>
            </ul>

            <hr class="my-2">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Ընդունման ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="admission_date" type="datetime-local"
                                value="{{date('Y-m-d\TH:i', strtotime($stationary->admission_date))}}" label="" />
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Դուրս գրման ամսաթիվը և ժամը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.text-field name="discharge_date" type="datetime-local"
                                {{-- value="{{date('Y-m-d\TH:i', strtotime($stationary->discharge_date))}}" label="" /> --}}
                                value="{{$stationary->discharge_date ? date('Y-m-d\TH:i', strtotime($stationary->discharge_date)) : null}}" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Հասակը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="height" id="height"
                                    value="{{old('height', $stationary->height)}}" min="1" step="0.01" label="" />
                                <label class="ml-2" for="height"><strong>սմ․</strong></label>
                            </div>
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Քաշը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <x-forms.text-field type="number" class="col-4" name="weight" id="weight"
                                    value="{{old('weight', $stationary->weight)}}" min="1" step="0.01" label="" />
                                <label class="ml-2" for="weight"><strong>կգ․</strong></label>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>Բաժանմունք՝</strong>
                        </div>
                        <div class="col-md-8">
                            <input id="departments-search" class="form-control" placeholder="ընտրել բաժանմունքը"
                                data-id="{{old('department_id', $stationary->department_id)}}" style="max-width: 100%">
                            <x-forms.text-field id="department_id" type="hidden" name="department_id"
                                value="{{old('department_id', $stationary->department_id)}}" label="" />
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>հիվանդասենյակ՝</strong>
                            <input id="rooms-search" class="form-control" placeholder="ընտրել հիվանդասենյակը"
                                data-id="{{old('chamber_id', $stationary->chamber)}}" style="max-width: 100%">
                            <x-forms.text-field id="chamber_id" type="hidden" name="chamber_id"
                                value="{{old('chamber_id', $stationary->chamber)}}" label="" />
                        </div>
                        <div class="col-md-6">
                            <strong>հիվանդասենյակի տիպը՝</strong>
                            <select class="form-control" name="is_paid">
                                <!--վճարովի-անվճար -->
                                <option value="0" {{old('is_paid', $stationary->is_paid) === "0" ? 'selected' : ''}}>անվճար
                                </option>
                                <option value="1" {{old('is_paid', $stationary->is_paid) === "1" ? 'selected' : ''}}>վճարովի
                                </option>
                            </select>
                            @error('is_paid')
                            <em class="error text-danger">{{$message}}</em>
                            @enderror
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>Մահճակալ՝</strong>
                            <input id="beds-search" class="form-control" placeholder="ընտրել մահճակալը․․․"
                                data-id="{{old('bed_id', $stationary->bed)}}" style="max-width: 100%">
                            <x-forms.text-field id="bed_id" type="hidden" name="bed_id"
                                value="{{old('bed_id', $stationary->bed)}}" label="" />
                        </div>
                        <div class="col-md-6">
                            <strong>օրերի քանակ՝</strong>
                            <x-forms.text-field type="number" name="days_qty"
                                value="{{old('days_qty', $stationary->days_qty)}}" min="0" label="" />
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Տեղափոխման ձևը՝</strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio1" value="1" name="by_wheelchair"
                                old-default="{{$stationary->by_wheelchair}}" label="հիվանդասայլակով" />
                            <x-forms.checkbox-radio pos="align" id="wheelchair-radio2" value="0" name="by_wheelchair"
                                old-default="{{$stationary->by_wheelchair}}" label="կարող է քայլել" />
                            @error('by_wheelchair')
                            <em class="error text-danger">{{$message}}</em>
                            @enderror
                        </div>
                    </div>
                </li>

            </ul>

            <hr class="my-2">
            <ul class="list-group">
                <!-- 0-9 start -->
                <!-- 1 -->
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">1.</span>
                        Ազգանուն, անուն, հայրանուն
                    </strong>
                    <ins class="ml-4">{{$patient->all_names}}</ins>
                </li>
                <!-- 2 -->
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">2.</span>
                        Սեռը՝
                    </strong>
                    <ins class="ml-4">{{$patient->sex}}</ins>
                </li>
                <!-- 3 -->
                <li class="list-group-item">
                    <strong>
                        <span class="badge badge-light mr-1">3.</span>
                        Տարիք՝ {{ $patient->age }}
                    </strong>
                    <ins class="ml-4"> ծննդյան թիվ՝ {{$patient->birth_date_reversed}}</ins>
                    {{-- <div class="input-group my-2">
                        <div class="input-group-prepend">
                            <select class="custom-select" id="age_type" name="age_type">
                                @foreach ($age_type_enums as $age_type)
                                <option value="{{$age_type}}"
                                    {{old('age_type', $stationary_array['age_type']) === $age_type?'selected':''}}>
                                    {{__("enums.stationary_age_type_enum.$age_type")}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <x-forms.text-field type="number" class="col-md-2" name="age" value="{{old('age', $stationary->age)}}"
                            min="1" max="200" label="" />
                    </div>
                    @error('age_type')
                    <div><em class="error text-danger">{{$message}}</em></div>
                    @enderror --}}
                    <em class="ml-2">*լրիվ տարիք, մինչև 1 տ․ երեխաների մոտ՝ ամիսներ, մինչև 1 ամս. երեխաների մոտ՝ օրեր:</em>
                </li>


                <!-- 4 -->
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

                <!-- 5 -->
                <li class="list-group-item">
                    <div class="form-row align-items-center">
                        <div class="col-md-6">
                            <strong>
                                <span class="badge badge-light mr-1">5.</span>
                                Աշխատավայրը՝
                            </strong>
                            @if ($patient->workplace)
                            <ins class="ml-4 d-block">{{$patient->workplace}}</ins>
                            @else
                            <x-forms.text-field type="text" class="mt-1" name="workplace" value="{{old('workplace')}}" label="" />
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>
                                <span class="badge badge-light mr-1">5.1</span>
                                մասնագիտությունը կամ պաշտոնը՝
                            </strong>
                            @if ($patient->profession)
                            <ins class="ml-4 d-block">{{$patient->profession}}</ins>
                            @else
                            <x-forms.text-field type="text" class="mt-1" name="profession" value="{{old('profession')}}" label="" />
                            @endif
                        </div>
                    </div>
                </li>

                <!-- 6 -->
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>
                                <span class="badge badge-light mr-1">6.</span>
                                Ում կողմից է ուղարկված հիվանդը՝
                            </strong>
                        </div>
                        <div class="col-md-8">
                            <x-forms.magic-search class="clinics-search" placeholder="ընտրել հաստատությունը․․․"
                                hidden-name="from_clinic_id" hidden-id="from_clinic_id"
                                value='{{old("from_clinic_id", $stationary->clinic_id)}}' />
                        </div>
                    </div>
                </li>

                <!-- 7 -->
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-7">
                            <strong>
                                <span class="badge badge-light mr-1">7.</span>
                                Ստացիոնար է տեղափոխվել անհետաձգելի ցուցումներով՝
                            </strong>
                        </div>
                        <div class="col-md-3">
                            <x-forms.checkbox-radio pos="align" id="urgent-radio1" value="1" name="is_urgent"
                                old-default="{{$stationary->is_urgent}}" label="Այո" />
                            <x-forms.checkbox-radio pos="align" id="urgent-radio2" value="0" name="is_urgent"
                                old-default="{{$stationary->is_urgent}}" label="Ոչ" />
                            @error('is_urgent')
                            <em class="error text-danger">{{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <hr class="hr-dashed">
                    <div class="row">
                        <div class="col-md-7">
                            <strong>
                                <span class="badge badge-light mr-1">7.1</span>
                                հիվանդության սկզբից՝
                            </strong>
                        </div>
                        <div class="col-md-3">
                            <x-forms.checkbox-radio pos="align" id="fds-radio1" value="1" name="from_disease_start"
                                old-default="{{$stationary->from_disease_start}}" label="Այո" />
                            <x-forms.checkbox-radio pos="align" id="fds-radio2" value="0" name="from_disease_start"
                                old-default="{{$stationary->from_disease_start}}" label="Ոչ" />
                            @error('from_disease_start')
                            <em class="error text-danger">{{$message}}</em>
                            @enderror
                        </div>
                    </div>

                    <hr class="hr-dashed">
                    <div class="form-row align-items-center">
                        <strong>
                            <span class="badge badge-light mx-1">7.2</span>
                            վնասվածք ստանալուց
                        </strong>
                        <x-forms.text-field type="number" class="col-sm-2 ml-2" name="hours_later"
                            value="{{old('hours_later', $stationary->hours_later)}}" min="1" max="1000" label="" />
                        <strong class="ml-2">ժամ անց,</strong>
                    </div>

                    <hr class="hr-dashed">
                    <div class="row">
                        <div class="col-md-7">
                            <strong>
                                <span class="badge badge-light mr-1">7.3</span>
                                հոսպիտալացվել է պլանային կարգով՝
                            </strong>
                        </div>
                        <div class="col-md-3">
                            <x-forms.checkbox-radio pos="align" id="planned-radio1" value="1" name="is_planned"
                                old-default="{{$stationary->is_planned}}" label="Այո" />
                            <x-forms.checkbox-radio pos="align" id="planned-radio2" value="0" name="is_planned"
                                old-default="{{$stationary->is_planned}}" label="Ոչ" />
                            @error('is_planned')
                            <em class="error text-danger">{{$message}}</em>
                            @enderror
                        </div>
                    </div>
                </li>
                {{-- <li class="list-group-item list-group-item-secondary">
                    <button type="submit" class="btn btn-primary">Պահպանել մինչև 7-րդ կետի փոփոխությունները</button>
                </li> --}}
                @include('shared.forms.list_group_item_submit', [
                    'btn_text' => 'Պահպանել մինչև 7-րդ կետի փոփոխությունները'
                ])
            </ul>
        </form>


        <!-- 8 -->
        {{-- section needs
        1) $route
        2) $sd_referring_institution
        3) $create_many_diagnoses
        4) $repeatables
        --}}
        <hr class="my-3">
        @include('stationary.stationary_referring_institution_diagnoses', [
            'route' => $route,
            'sd_referring_institution' =>$sd_referring_institution,
            'create_many_diagnoses' => $create_many_diagnoses,
            'repeatables' => $repeatables
        ])

        <!-- 9 -->
        {{-- section needs
        1) $route
        2) $sd_admission
        3) $create_many_diagnoses
        4) $repeatables
        --}}
        <hr class="my-2">
        @include('stationary.stationary_admission_diagnoses',[
            'route' => $route,
            'sd_admission' =>$sd_admission,
            'create_many_diagnoses' => $create_many_diagnoses,
            'repeatables' => $repeatables
        ])


        <!-- 0-9 end -->


        <!-- 10-19 -->

        <!-- 10 -->
        {{-- section needs
        1) $route
        2) $sd_clinical
        3) $update_diagnosis
        4) $repeatables - no need
        --}}
        <hr class="my-3">
        @include('stationary.stationary_clinical_diagnoses',[
            'route' => $route,
            'sd_clinical' =>$sd_clinical,
            'update_diagnosis' => $update_diagnosis
        ])


        <ul class="list-group">
            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">11.</span>
                    Վերջնական կլինիկական ախտորոշումը՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_final_clinical"}}' />


                <!-- 11.ա) հիմնական -->
                {{-- section needs
                1) $route
                2) $sd_final_clinical
                3) $update_diagnosis
                4) $repeatables - no need
                --}}
                <hr class="hr-dashed" id="final_clinical_diagnoses">
                @include('stationary.stationary_final_clinical_diagnoses', [
                    'route' => $route,
                    'sd_final_clinical' =>$sd_final_clinical,
                    'update_diagnosis' => $update_diagnosis
                ])


                <!-- 11.բ)  հիմնական հիվանդության բարդություն -->
                {{-- section needs
                1) $route
                2) $sd_disease_complication
                3) $update_diagnosis
                4) $repeatables - no need
                --}}
                <hr class="hr-dashed" id="disease_complication">
                @include('stationary.stationary_disease_complications', [
                    'route' => $route,
                    'sd_disease_complication' =>$sd_disease_complication,
                    'update_diagnosis' => $update_diagnosis
                ])


                <!-- 11.գ)  հիմնական հիվանդության բարդություն -->
                {{-- section needs
                1) $route
                2) $sd_concomitant_disease
                3) $update_diagnosis
                4) $repeatables - no need
                --}}
                <hr class="hr-dashed" id="concomitant_disease">
                @include('stationary.stationary_concomitant_disease', [
                    'route' => $route,
                    'sd_concomitant_disease' =>$sd_concomitant_disease,
                    'update_diagnosis' => $update_diagnosis
                ])


                <!-- 11.դ)  տուբերկուլյոզին բնորոշ գանգատներ -->
                {{-- section needs
                1) $route
                2) $sd_tuberculosis_complaint
                3) $update_diagnosis
                4) $repeatables - no need
                --}}
                <hr class="hr-dashed" id="tuberculosis_complaints">
                @include('stationary.stationary_tuberculosis_complaints', [
                    'route' => $route,
                    'sd_tuberculosis_complaint' =>$sd_tuberculosis_complaint,
                    'update_diagnosis' => $update_diagnosis
                ])

                <hr class="hr-dashed">
                <div class="row">
                    <div class="col-md-5">
                        <strong>
                            <span class="badge badge-light mr-1">11.ե)</span>
                            Մալարիայի էնդեմիկ գոտում՝
                        </strong>
                    </div>
                    <div class="col-md-7">
                        <x-forms.checkbox-radio pos="align" id="malaria-radio1" value="1" form="update_11_17"
                            old-default="{{$stationary_array['malaria_endemic_zone']}}" name="malaria_endemic_zone"
                            label="եղել է" />
                        <x-forms.checkbox-radio pos="align" id="malaria-radio2" value="0" form="update_11_17"
                            old-default="{{$stationary_array['malaria_endemic_zone']}}" name="malaria_endemic_zone"
                            label="չի եղել" />
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <strong class="mr-2">
                        <span class="badge badge-light mx-1">12.</span>
                        Տվյալ տարում հիվանդության կապակցությամբ հոսպիտալացվել է
                    </strong>
                    <x-forms.text-field type="number" class="col-md-2" name="times_hospitalized" min="0"
                        value="{{$stationary_array['times_hospitalized']}}" label="" form="update_11_17" />
                    <strong class="ml-2">անգամ</strong>
                </div>
            </li>
        </ul>

        <!-- 13)  Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ -->
        {{-- section needs
        1) $route
        2) $stationary_surgeries
        3) $create_surgery
        4) $repeatables - no need
        --}}
        <hr class="my-2">
        @include('stationary.stationary_surgery_complications', [
            'route' => $route,
            'stationary_surgeries' =>$stationary_surgeries,
            'create_surgery' => $create_surgery
        ])

        <!-- 14.1)  Բուժման այլ տեսակներ -->
        {{-- section needs
        1) $route
        2) $$stationary_treatments
        3) $create_other_treatment
        4) $repeatables - no need
        --}}
        <hr class="my-2">
        @include('stationary.stationary_other_treatments', [
            'route' => $route,
            'stationary_treatments' =>$stationary_treatments,
            'create_other_treatment' => $create_other_treatment
        ])

        <hr class="my-2">
        <ul class="list-group">
            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mx-1">14.2</span>
                    Չարորակ նորագոյություններով հիվանդների համար՝
                </strong>
                <div class="container">
                    <div class="col-md-12">
                        {{-- tumor_treatment_enums --}}

                        @foreach ($tt_grouped as $key => $tt_item)
                        <div class="row">
                            <strong class="col-md-5 col-form-label">
                                {{ __("enums.tumor_treatment_enum.$key") }}
                            </strong>
                            <div class="col-md-7 col-form-label">

                                @foreach ($tt_item as $item)
                                <x-forms.checkbox-radio pos="valign" id="tt-{{$item['id']}}" value="{{$item['id']}}"
                                    type="checkbox" name="tumor_treatment_id[]" label="{{$item['name']}}"
                                    check="{{$stationary_tt->contains($item['id'])}}" form="update_11_17"/> <!-- old-default="$item['id']" -->
                                @endforeach

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </li>
        </ul>

        <!-- 15)  Նշումներ անաշխատունակության թերթիկ տրման մասին -->
        {{-- section needs
        1) $route
        2) $stationary_disability_certificates
        3) $create_disability_certificate
        4) $repeatables - no need
        --}}
        <hr class="my-2">
        @include('stationary.stationary_disability_certificates', [
            'route' => $route,
            'stationary_disability_certificates' =>$stationary_disability_certificates,
            'create_disability_certificate' => $create_disability_certificate
        ])

    <form action="{{route('patients.stationary.update', ["patient" => $patient, "stationary" => $stationary])}}"
        method="POST" id="update_11_17" class="ajax-submitable dont-reset">
        @method('PATCH')
        @csrf

        <hr class="my-2">
        <ul class="list-group">
            <li class="list-group-item">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>
                            <span class="badge badge-light">16.1</span>
                            Հիվանդության ելքը՝
                        </strong>
                        {{-- stationary_disease_outcome_enums --}}
                        <?php
                                $stationary_outcome_id = null;
                                $stationary_outcome_date = null;
                                $stationary_transferred_clinic_id = null;
                                $stationary_death_circumstance = null;
                                if($stationary->stationary_disease_outcomes) {
                                    $stationary_outcome_id = $stationary->stationary_disease_outcomes->outcome->getValue();
                                    $stationary_outcome_date = date('Y-m-d',strtotime($stationary->stationary_disease_outcomes->outcome_date));
                                    $stationary_transferred_clinic_id = $stationary->stationary_disease_outcomes->transferred_clinic_id;
                                    $stationary_death_circumstance = $stationary->stationary_disease_outcomes->death_circumstance;
                                }

                            ?>
                        <select name="disease_outcome_id" class="form-control mt-1">
                            <option value="">ընտրել հիվանդության ելքը․․․</option>
                            @foreach ($stationary_disease_outcome_enums as $disease_outcome)
                            <option value="{{$disease_outcome}}" @if (old('disease_outcome_id',
                                $stationary_outcome_id)===$disease_outcome) selected='selected' @endif>
                                {{__("enums.stationary_disease_outcome_enum.$disease_outcome")}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <strong>
                            դուրս է գրվել՝
                        </strong>
                        <x-forms.text-field type="date" name="disease_outcome_date" class="mt-1"
                            value="{{$stationary_outcome_date}}" label="" />
                    </div>
                </div>

                <hr class="hr-dashed">
                <div class="form-row align-items-center">
                    <div class="col-md-6">
                        <strong>
                            <span class="badge badge-light">16.2</span>
                            Տեղափոխվել է այլ հաստատություն՝
                        </strong>

                        <x-forms.magic-search class="clinics-search mt-1" placeholder="ընտրել հաստատությունը․․․"
                            hidden-name="moved_to_clinic_id" hidden-id="moved_to_clinic_id"
                            value='{{old("moved_to_clinic_id", $stationary_transferred_clinic_id)}}' />
                    </div>
                    <div class="col-md-6">
                        <strong>
                            մահացել է՝
                        </strong>
                        {{-- stationary_death_circumstance_enums --}}
                        <select name="death_circumstance_id" class="form-control mt-1">
                            <option value="">ընտրել մահվան հանգամանքը․․․</option>
                            @foreach ($death_circumstances_enums as $death_circumstance)
                            <option value="{{$death_circumstance}}" @if (old('death_circumstance_id',
                                $stationary_death_circumstance)===$death_circumstance) selected='selected' @endif>
                                {{__("enums.stationary_death_circumstance_enum.$death_circumstance")}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light">17.</span>
                    Աշխատունակությունը՝
                </strong>
                <div class="container">
                    <div class="col-md-12 my-2">
                        {{-- stationary_work_efficiency_enums --}}

                        @foreach ($work_efficiency_enums as $item)
                        <x-forms.checkbox-radio pos="valign" id="workability-{{$item}}" value="{{$item}}" type="radio"
                            name="workability" label='{{__("enums.stationary_work_efficiency_enum.$item")}}'
                            check="{{$stationary_array['work_efficiency_status'] === $item}}" />
                        @endforeach
                        <textarea name="workability_comment" class="form-control mt-2"
                            placeholder="այլ պատճառների մեկնաբանություն․․․">{{$stationary_array["work_efficiency_comment"]}}</textarea>
                    </div>
                </div>
            </li>
            @include('shared.forms.list_group_item_submit', [
                'btn_text' => 'Պահպանել 11.ե-17 կետերի փոփոխությունները'
            ])
        </ul>
    </form>

        <!-- 18. Փորձաքննության ընդունվածների համար, եզրակացություն՝ -->
        {{-- section needs
        1) $route
        2) $stationary_expertise_conclusions
        3) $create_expertise_conclusion
        4) $repeatables - no need
        --}}
        <hr class="my-2">
        @include('stationary.stationary_expertise_conclusions', [
            'route' => $route,
            'stationary_expertise_conclusions' =>$stationary_expertise_conclusions,
            'create_expertise_conclusion' => $create_expertise_conclusion
        ])


        <!-- 19)  Հյուսվածքաբանական հետազոտության արդյունքը -->
        {{-- section needs
        1) $route
        2) $stationary_histological_examinations
        3) $create_histological_examination
        4) $repeatables - no need
        --}}
        <hr class="my-2">
        @include('stationary.stationary_histological_examinations', [
            'route' => $route,
            'stationary_histological_examinations' =>$stationary_histological_examinations,
            'create_surgery' => $create_surgery
        ])

        <hr class="my-2">
        <ul class="list-group">
            <form action="{{route('patients.stationary.update', ["patient" => $patient, "stationary" => $stationary])}}"
                method="POST" id="update_after_19" class="ajax-submitable dont-reset">
                @method('PATCH')
                @csrf
                <li class="list-group-item">
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-md-6">
                            <strong>բուժող բժիշկ</strong>

                            <x-forms.magic-search class="doctors-search mt-1" placeholder="ընտրել բուժող բժշկին․․․"
                                value='{{old("attending_doctor_id", $stationary->attending_doctor_id)}}'
                                hidden-id="attending_doctor_id" hidden-name="attending_doctor_id" />
                        </div>
                        <div class="col-md-6">
                            <strong>բաժանմունքի վարիչ</strong>

                            <x-forms.magic-search class="doctors-search mt-1" placeholder="ընտրել բուժող բժշկին․․․"
                                value='{{old("department_head_id", $stationary->department_head_id)}}'
                                hidden-id="department_head_id" hidden-name="department_head_id" />
                        </div>
                    </div>
                </li>
                @include('shared.forms.list_group_item_submit', [
                    'btn_text' => 'Պահպանել "բուժող բժիշկ", "բաժանմունքի վարիչ" տվյալները'
                ])
            </form>
        </ul>

    <!-- submit:Պահպանել մինչև 19-րդ կետի փոփոխությունները -->



<hr class="my-4">
@include('stationary.stationary_primary_examination',
["patient" => $patient,
"stationary" => $stationary,
"repeatables" => $repeatables])

<hr class="my-4">
@include('stationary.stationary_present_status', [
    "patient" => $patient,
    "stationary" => $stationary,
    "examination_program_default_array" => $examination_program_default_array
])

<hr class="my-4">
@include('stationary.stationary_ultrasound_and_endoscopy', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_xray_examination', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_cellular_examination', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_expert_advice', [
    "patient" => $patient,
    "stationary" => $stationary ,
    "user"=> $user
])

<hr class="my-4">
@include('stationary.stationary_for_analysis', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_surgery_justification', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_surgery_protocol', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_surgery_description', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_disease_course', [
    "patient" => $patient,
    "stationary" => $stationary,
    "repeatables"=>$repeatables
])

<hr class="my-4">
@include('stationary.stationary_resuscitation_department', [
    "patient" => $patient,
    "stationary" => $stationary,
    'user'=> $user
])

<hr class="my-4">
@include('stationary.stationary_epicrisis', [
    "patient" => $patient,
    "stationary" => $stationary
])


<hr class="my-4">
@include('stationary.stationary_pathological_anatomical', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_special_note', [
    "patient" => $patient,
    "stationary" => $stationary
])

<hr class="my-4">
@include('stationary.stationary_treatment_evaluation', [
    "patient" => $patient,
    "stationary" => $stationary
])

</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js')}}"></script>

<script>
    var repeatables = {{$repeatables}};
    var departments = {!! json_encode($departments) !!};
    var chambers = {!! json_encode($chambers) !!};
    var beds = {!! json_encode($beds) !!};


    $('#beds-search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: beds,
            fields: ['number'],
            id:'id',
            format:'%number%',
            success: function($input, data) {
                $('#bed_id').val($input.attr('data-id'));
            },
            disableRule: function(data) {
                return  (data.is_occupied === "true") ? true : false;
            },
        })
    );

    // [{id:0, number:'a. Նախ ընտրեք բաժինը', department_id: 0}],
    $('#rooms-search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: chambers,
            fields: ['number'],
            id:'id',
            format:'%number%',
            success: function($input, data) {
                $('#chamber_id').val($input.attr('data-id'));
                var filtered_beds = beds.filter(bed => bed.chamber_id == $input.attr('data-id')); // && !bed.is_occupied
                $('#beds-search').trigger('update', {dataSource: filtered_beds});
            },
            afterDelete: function($input, data) {
                $('#beds-search').trigger('update',{dataSource: beds});
            }
        })
    );

    $('#departments-search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            // dataSource: '/catalogs/departments.json',
            // type:'ajax',
            dataSource: departments,
            fields: ['id','name'],
            id:'id',
            format:'%id% - %name%',
            success: function($input, data) {
                // JSON.stringify(data)  $input.attr('data-id')
                console.log(JSON.stringify(data))
                console.log($input)
                $('#department_id').val($input.attr('data-id'));
                var filtered_chambers = chambers.filter(chamber => chamber.department_id == $input.attr('data-id'));
                $('#rooms-search').trigger('update',{dataSource: filtered_chambers});
            },
            afterDelete: function($input, data) {
                $('#rooms-search').trigger('update',{dataSource: chambers});
            }
        })
    );

    // $('[name="workability"]').on('click', function(){
    //    $('[name="workability_comment"]').hide(200);
    // })
    // $('#workability-radio5').on('click', function(){
    //     $('[name="workability_comment"]').show(200);
    // })

    // $(".medicines-search").magicsearch(
    //     window.medexMagicSearch.assignConfigs({
    //         dataSource: "/catalogs/medicines.json",
    //         type: "ajax",
    //         success: function($input, data) {
    //             const hidden_id = $input.data("hidden");
    //             $(hidden_id).val($input.attr("data-id"));
    //         }
    //     })
    // );


    // $('.diagnoses-search').magicsearch(
    //     window.medexMagicSearch.assignConfigs({
    //         dataSource: "/catalogs/diseases.json",
    //         type: "ajax",
    //         success: function($input, data) {
    //             const hidden_input_id = $input.data('hidden');
    //             $(hidden_input_id).val($input.attr("data-id"));
    //         }
    //     })
    // );

    // $('.surgery-search').magicsearch(
    //     window.medexMagicSearch.assignConfigs({
    //         dataSource: "/catalogs/surgeries.json",
    //         type: "ajax",
    //         success: function($input, data) {
    //             // $("#surgery_id").val($input.attr("data-id"));
    //             const hidden_input_id = $input.data('hidden');
    //             $(hidden_input_id).val($input.attr("data-id"));
    //         }
    //     })
    // );

    // $('.anesthesia-methods-search').magicsearch(
    //     window.medexMagicSearch.assignConfigs({
    //         dataSource: "/catalogs/anesthesias.json",
    //         type: "ajax",
    //         success: function($input, data) {
    //             // $("#anesthesia_id").val($input.attr("data-id"));
    //             const hidden_input_id = $input.data('hidden');
    //             $(hidden_input_id).val($input.attr("data-id"));
    //         }
    //     })
    // );

    $('.doctors-search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: "/lists/users.json",
            type: "ajax",
            success: function($input, data) {
                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            }
        })
    );

    $('.treatments-search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: "/catalogs/treatments.json",
            type: "ajax",
            success: function($input, data) {
                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            }
        })
    );

    $('.clinics-search').magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: '/catalogs/clinics.json',
            type:'ajax',
            success: function($input, data) {
                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr('data-id'));
            }
        })
    );



    jQuery(document).ready(function() {
        var hash = window.location.hash;
        console.log(hash);
        if(hash && jQuery(hash)) {
            console.log(jQuery(hash));
            jQuery([document.documentElement, document.body]).animate({
                scrollTop: jQuery(hash).offset().top - 120
            }, 200);
            // removing hash with '#' from url (wrpper_id: window.location.hash = '')
            var hashPos = window.location.href.search(hash);
            window.history.pushState({},'',window.location.href.slice(0, hashPos));
        }
    });
</script>
@endsection
