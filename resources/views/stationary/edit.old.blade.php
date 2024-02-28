@extends('layouts.cardBase')

@php
# route for
# 17.11.2020 - տեղափոխել եմ միայն կնոպկեն 1-19-ի, ու ֆորմ-ը,
# ֆորմի տակից փակել եմ ul-ն ու բացել եմ նորը։


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
    <form action="{{route('patients.stationary.update', ["patient" => $patient, "stationary" => $stationary])}}"
        method="POST">
        @method('PATCH')
        @csrf
        {{-- <button type="button" class="btn btn-lg btn-primary"
            style="position: fixed; bottom:20px; right:20px; z-index: 10">
            <x-svg icon="cui-file" />
        </button> --}}

        <ul class="list-group text-center">
            <li class="list-group-item">
                <strong>
                    Հիմնական հիվանդության ախտորոշումը՝ <small>գրվում է դուրս գրումից հետո</small>
                    <x-forms.prev-posts-link href='{{$route . "#stationary_diagnosis_primary_disease"}}' />
                </strong>
                <div class="container">
                    <div class="col-md-12 my-2">
                        <div class="react-select-container" data-name="primary_disease_diagnosis_id"
                            data-old-value="{{old('primary_disease_diagnosis_id')}}"></div>
                    </div>
                    <div class="col-md-12 my-2">
                        <textarea name="primary_disease_diagnosis_comment" class="form-control"
                            placeholder="ազատ գրառման դաշտ․․․">{{old('primary_disease_diagnosis_comment')}}</textarea>
                    </div>
                </div>
            </li>
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
                        {{-- <div class="col-md-6">
                            <strong>TNM</strong>
                            <em>T - (0,1,2,3,4)</em>
                            <em>N - (0,1,2,3,x)</em>
                            <em>M - (0,1,x)</em>
                            <x-forms.text-field name="tnm" value="{{$stationary->tnm}}" class="mr-1" maxlength="3"
                                label="" />
                        </div> --}}
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

        <hr class="my-4">
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
            <li class="list-group-item">
                @if ($mse_intolerance)
                <div class="collapse medicine-intolerance-collapse">
                    <strong>Դեղանյութերի կողմնակի ազդեցությունը (անտանելիությունը)՝</strong>
                    <x-forms.prev-posts-link href='{{$route . "#stationary_medicine_side_effect_intolerance"}}' size='md' />

                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".medicine-intolerance-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    {{-- @foreach ($mse_intolerance as $item)

                    <div id="llllllll48">
                        <span>
                            <form action="{{ route("patients.stationary.medicine_side_effects") }}" method="POST" class="ajax-submitable dont-reset">
                                @method("PUT")
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <ul class="list-group mt-2">
                                    <li class="list-group-item">
                                        <div class="container">
                                            <div class="col-md-12 my-2">
                                                <x-forms.magic-search class="magic-search ajax" data-catalog-name="medicines" value='{{ $item->medicine_id }}'
                                                    hidden-id="old_side_effect_medicine_{{ $item->id }}" hidden-name="medicine_id"
                                                    placeholder="Ընտրել դեղամիջոցը․․" />
                                            </div>
                                            <div class="col-md-12 my-2">
                                                <x-forms.text-field type="textarea" name="medicine_comment" placeholder="ազատ գրառման դաշտ․․․" value="{{ $item->medicine_comment }}" validationType="ajax" />
                                            </div>
                                        </div>
                                    </li>
                                    @include('shared.forms.list_group_item_submit')
                                </ul>
                            </form>
                        </span>
                    </div>

                    @endforeach --}}

                    {{-- @each('shared.forms.stationary_edit_sections.stationary_medicine_side_effects', $mse_intolerance, 'item') --}}
                </div>
                @endif

                <div class="collapse show medicine-intolerance-collapse">
                    <strong>Դեղանյութերի կողմնակի ազդեցությունը (անտանելիությունը)՝</strong>

                    <x-forms.prev-posts-link href='{{$route . "#stationary_medicine_side_effect_intolerance"}}' size='md' />

                    <x-forms.add-reduce-button type="add" data-row=".side-effect-medicine-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".side-effect-medicine-row" />
                    <x-forms.hidden-counter class="side-effect-medicine-rows" name="side_effect_medicine_length" />

                    @if ($mse_intolerance)
                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".medicine-intolerance-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                    @endif

                    @for ($i = 0; $i < $repeatables; $i++)
                    <div class="container side-effect-medicine-row {{$i < old('side_effect_medicine_length', 1) ?' ':'d-none'}}">
                        <div class="col-md-12 my-2">

                            <x-forms.magic-search class="magic-search ajax" data-catalog-name="medicines" value='{{old("side_effect_medicine_id.$i")}}'
                                hidden-id="side_effect_medicine_{{$i}}" hidden-name="side_effect_medicine_id[]"
                                placeholder="Ընտրել դեղամիջոցը․․" />
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="side_effect_medicine_comment[]" class="form-control"
                                placeholder="ազատ գրառման դաշտ․․․">{{old("side_effect_medicine_comment.$i")}}</textarea>
                        </div>
                    </div>
                    @endfor
                </div>
            </li>
        </ul>

        <hr class="my-4">
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


            <!-- 8 -->
            <li class="list-group-item">
                @if ($sd_referring_institution)
                <div class="collapse referring-institutuion-diagnosis">
                    <strong>
                        <span class="badge badge-light mr-1">8.</span>
                        Ուղեգրող հաստատության ախտորոշումը՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#referring_institution_diagnoses"}}' size='md' />

                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".referring-institutuion-diagnosis">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @foreach ($sd_referring_institution as $referring_key => $item)
                        @include('shared.forms.stationary_edit_sections.stationary_diagnoses', [
                            'item' => $item,
                            // 'included_action_route' => $route_diagnosis,
                            // 'included_form_method' => 'PATCH',
                            // 'included_submit_txt' => 'փոփոխել',
                            'has_hidden_type' => true,
                            // 'has_diagnosis_date' => false,
                            'row_name' => __("enums.stationary_diagnosis_enum." . $item->diagnosis_type),
                            'route_delete' => route('patients.stationary.delete_diagnoses')
                        ])
                    @endforeach

                    {{-- @each('shared.forms.stationary_edit_sections.stationary_diagnoses', $sd_referring_institution, 'item') --}}
                </div>
                @endif

                <div class="collapse show referring-institutuion-diagnosis">
                    <strong>
                        <span class="badge badge-light mr-1">8.</span>
                        Ուղեգրող հաստատության ախտորոշումը՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_referring_institution"}}' size='md' />

                    <x-forms.add-reduce-button type="add" data-row=".referring-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".referring-row" />
                    <x-forms.hidden-counter class="referring-rows" name="referring_diagnosis_length" />

                    @if ($sd_referring_institution)
                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".referring-institutuion-diagnosis">
                        <x-svg icon="cui-pencil" />
                    </button>
                    @endif

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container referring-row {{$i<old('referring_diagnosis_length', 1) ?' ':'d-none'}}">
                            <div class="col-md-12 my-2">
                                <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases" value='{{old("referring_diagnosis.$i")}}'
                                    hidden-id="referring_diagnosis_{{$i}}" hidden-name="referring_diagnosis[]"
                                    placeholder="Ընտրել ախտորոշումը․․․" />
                            </div>
                            <div class="col-md-12 my-2">
                                <textarea name="referring_diagnosis_comment[]" class="form-control"
                                    placeholder="ազատ գրառման դաշտ․․․">{{old("referring_diagnosis_comment.$i")}}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </li>
            <!-- 9 -->
            <li class="list-group-item">

                @if ($sd_admission)
                <div class="collapse admission-diagnoses-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">9.</span>
                        Ախտորոշումն ընդունվելիս՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#admission_diagnoses"}}' size='md' />

                    <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".admission-diagnoses-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @foreach ($sd_admission as $admission_key => $item)
                        @include('shared.forms.stationary_edit_sections.stationary_diagnoses', [
                            'item' => $item,
                            // 'included_action_route' => $route_diagnosis,
                            // 'included_form_method' => 'PATCH',
                            // 'included_submit_txt' => 'փոփոխել',
                            'has_hidden_type' => true,
                            // 'has_diagnosis_date' => false,
                            'row_name' => __("enums.stationary_diagnosis_enum." . $item->diagnosis_type),
                            'route_delete' => route('patients.stationary.delete_diagnoses')
                        ])
                    @endforeach

                    {{-- @each('shared.forms.stationary_edit_sections.stationary_diagnoses', $sd_admission, 'item') --}}
                </div>
                @endif

                <div class="collapse show admission-diagnoses-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">9.</span>
                        Ախտորոշումն ընդունվելիս՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_admission"}}' size='md' />

                    <x-forms.add-reduce-button type="add" data-row=".admission-row" />
                    <x-forms.add-reduce-button type="reduce" data-row=".admission-row" />
                    <x-forms.hidden-counter class="admission-rows" name="admission_diagnosis_length" />

                    @if ($sd_admission)
                        <button class="btn btn-primary float-right" type="button" data-toggle="collapse" data-target=".admission-diagnoses-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    @for ($i = 0; $i < $repeatables; $i++)
                        <div class="container admission-row {{$i<old('admission_diagnosis_length', 1)?' ':'d-none'}}">
                            <div class="col-md-12 my-2">
                                <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases" value='{{old("admission_diagnosis.$i")}}'
                                    hidden-id="admission_diagnosis_{{$i}}" hidden-name="admission_diagnosis[]"
                                    placeholder="Ընտրել ախտորոշումը․․․" />
                            </div>
                            <div class="col-md-12 my-2">
                                <textarea name="admission_diagnosis_comment[]" class="form-control"
                                    placeholder="ազատ գրառման դաշտ․․․">{{old("admission_diagnosis_comment.$i")}}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </li>
            <!-- 0-9 end -->

            <!-- 10-19 -->
        <ul class="list-group text-center">
            <li class="list-group-item">
                @if ($sd_clinical)
                <div class="collapse clinical-diagnoses-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">10.</span>
                        Կլինիկական ախտորոշումը՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_clinical"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".clinical-diagnoses-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @foreach ($sd_clinical as $clinical_key => $item)
                        @include('shared.forms.stationary_edit_sections.stationary_diagnoses', [
                            'item' => $item,
                            // 'included_action_route' => $route_diagnosis,
                            // 'included_form_method' => 'PATCH',
                            // 'included_submit_txt' => 'փոփոխել',
                            'has_hidden_type' => true,
                            'has_diagnosis_date' => true,
                            'row_name' => __("enums.stationary_diagnosis_enum." . $item->diagnosis_type),
                            'route_delete' => route('patients.stationary.delete_diagnoses')
                        ])
                    @endforeach

                    {{-- @forelse ($sd_clinical as $item)
                        @include('shared.forms.stationary_edit_sections.stationary_diagnoses', ["item" => $item, "has_diagnosis_date" => true])
                    @empty --}}

                    {{-- @endforelse --}}
                </div>
                @endif

                <div class="collapse show clinical-diagnoses-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">10.</span>
                        Կլինիկական ախտորոշումը՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_clinical"}}' />

                    @if ($sd_clinical)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".clinical-diagnoses-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="container mt-2">
                        <div class="col-md-12 my-2">
                            <div class="react-select-container" data-name="clinical_diagnosis_id"></div>
                        </div>
                        <div class="col-md-12 my-2">
                            <x-forms.text-field type="date" name="clinical_diagnosis_date" label="" />
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="clinical_diagnosis_comment" class="form-control"
                                placeholder="ազատ գրառման դաշտ․․․">{{old('clinical_diagnosis_comment')}}</textarea>
                        </div>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mr-1">11.</span>
                    Վերջնական կլինիկական ախտորոշումը՝
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_final_clinical"}}' />

                <hr class="hr-dashed">
                @if ($sd_final_clinical)
                <div class="collapse final-clinical-diagnoses-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.ա)</span>
                        հիմնական՝
                    </strong>

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".final-clinical-diagnoses-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @forelse ($sd_final_clinical as $item)
                        @include('shared.forms.stationary_edit_sections.stationary_diagnoses', ["item" => $item, "has_diagnosis_date" => true])
                    @empty

                    @endforelse
                </div>
                @endif

                <div class="collapse show final-clinical-diagnoses-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.ա)</span>
                        հիմնական՝
                    </strong>

                    @if ($sd_final_clinical)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".final-clinical-diagnoses-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="container mt-2">
                        <div class="col-md-12 my-2">
                            <div class="react-select-container" data-name="final_clinical_diagnosis_id"></div>
                        </div>
                        <div class="col-md-12 my-2">
                            <x-forms.text-field type="date" name="final_clinical_diagnosis_date" label="" />
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="final_clinical_diagnosis_comment" class="form-control"
                                placeholder="ազատ գրառման դաշտ․․․"></textarea>
                        </div>
                    </div>
                </div>

                <hr class="hr-dashed">

                @if ($sd_disease_complication)
                <div class="collapse disease-complications-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.բ)</span>
                        հիմնական հիվանդության բարդություն՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_disease_complication"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disease-complications-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @each('shared.forms.stationary_edit_sections.stationary_diagnoses', $sd_disease_complication, 'item')
                </div>
                @endif

                <div class="collapse show disease-complications-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.բ)</span>
                        հիմնական հիվանդության բարդություն՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_disease_complication"}}' />

                    @if ($sd_disease_complication)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disease-complications-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="container mt-2">
                        <div class="col-md-12 my-2">
                            <!-- complication of the underlying disease -->
                            <div class="react-select-container" data-name="underlying_disease_complication_id"></div>
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="underlying_disease_complication_comment" class="form-control"
                                placeholder="ազատ գրառման դաշտ․․․"></textarea>
                        </div>
                    </div>
                </div>

                <hr class="hr-dashed">

                @if ($sd_concomitant_disease)
                <div class="collapse concomitant-diseases-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.գ)</span>
                        ուղեկցող հիվանդության բարդություն՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_concomitant_disease"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".concomitant-diseases-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @each('shared.forms.stationary_edit_sections.stationary_diagnoses', $sd_concomitant_disease, 'item')
                </div>
                @endif

                <div class="collapse show concomitant-diseases-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.գ)</span>
                        ուղեկցող հիվանդության բարդություն՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_concomitant_disease"}}' />

                    @if ($sd_concomitant_disease)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".concomitant-diseases-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="container mt-2">
                        <div class="col-md-12 my-2">
                            <!-- complication of concomitant disease -->
                            <div class="react-select-container" data-name="concomitant_disease_complication_id"></div>
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="concomitant_disease_complication_comment" class="form-control"
                                placeholder="ազատ գրառման դաշտ․․․"></textarea>
                        </div>
                    </div>
                </div>

                <hr class="hr-dashed">

                @if ($sd_tuberculosis_complaint)
                <div class="collapse tuberculosis-complaints-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.դ)</span>
                        տուբերկուլյոզին բնորոշ գանգատներ՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_tuberculosis_complaint"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".tuberculosis-complaints-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @each('shared.forms.stationary_edit_sections.stationary_diagnoses', $sd_tuberculosis_complaint, 'item')
                </div>
                @endif

                <div class="collapse show tuberculosis-complaints-collapse">
                    <strong>
                        <span class="badge badge-light mr-1">11.դ)</span>
                        տուբերկուլյոզին բնորոշ գանգատներ՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_diagnosis_tuberculosis_complaint"}}' />

                    @if ($sd_tuberculosis_complaint)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".tuberculosis-complaints-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="container">
                        <div class="col-md-12 my-2">
                            <!-- complication of concomitant disease -->
                            <div class="react-select-container" data-name="tuberculosis_complaints_id"></div>
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="tuberculosis_complaints_comment" class="form-control"
                                placeholder="ազատ գրառման դաշտ․․․"></textarea>
                        </div>
                    </div>
                </div>

                <hr class="hr-dashed">
                <div class="row">
                    <div class="col-md-5">
                        <strong>
                            <span class="badge badge-light mr-1">11.ե)</span>
                            Մալարիայի էնդեմիկ գոտում՝
                        </strong>
                    </div>
                    <div class="col-md-7">
                        <x-forms.checkbox-radio pos="align" id="malaria-radio1" value="1"
                            old-default="{{$stationary_array['malaria_endemic_zone']}}" name="malaria_endemic_zone"
                            label="եղել է" />
                        <x-forms.checkbox-radio pos="align" id="malaria-radio2" value="0"
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
                        value="{{$stationary_array['times_hospitalized']}}" label="" />
                    <strong class="ml-2">անգամ</strong>
                </div>
            </li>

            <li class="list-group-item">
                @if ($stationary_surgeries)
                <div class="collapse surgeries-collapse">
                    <strong>
                        <span class="badge badge-light">13.</span>
                        Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_surgeries"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".surgeries-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @each('shared.forms.stationary_edit_sections.stationary_surgeries', $stationary_surgeries, 'item')
                </div>
                @endif

                <div class="collapse show surgeries-collapse">
                    <strong>
                        <span class="badge badge-light">13.</span>
                        Վիրահատություններ, անզգայացման եղանակներ և հետվիրահատական բարդություններ
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_surgeries"}}' />

                    @if ($stationary_surgeries)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".surgeries-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="container surgery-row mt-2">
                        <div class="col-md-12 my-2">
                            <x-forms.text-field name="surgery_datetime" type="datetime-local" label="" />
                        </div>
                        <div class="col-md-12 my-2">
                            <x-forms.magic-search class="magic-search ajax" data-catalog-name="surgeries" value='{{old("surgery_id")}}' hidden-id="surgery_id"
                                hidden-name="surgery_id" placeholder="ընտրել վիրահատությունը․․․" />
                        </div>
                        <div class="col-md-12 my-2">
                            <x-forms.magic-search class="magic-search ajax" data-catalog-name="anesthesias" value='{{old("anesthesia_id")}}'
                                hidden-id="anesthesia_id" hidden-name="anesthesia_id" placeholder="ընտրել անզգայացման եղանակը․․․" />
                        </div>
                        <div class="col-md-12 my-2">
                            <textarea name="surgery_complication_comment" class="form-control"
                                placeholder="վիրահատման բարդություններ․․․">{{old('surgery_complication_comment')}}</textarea>
                        </div>
                        <div class="col-md-12 my-2">
                            <!-- վիրահատող -->
                            <em class="ml-2 text-info">* Տվյալ կետը լարցնողը ավտոմատ կերպով ֆիքսվում է իբրև վիրահատող։</em>
                            {{-- <input class="doctors-search form-control" data-hidden="#surgeon_id" placeholder="վիրահատել է․․․">
                                <x-forms.text-field type="hidden" id="surgeon_id" name="surgeon_id"  value="" label=""/> --}}
                        </div>
                    </div>
                </div>

            </li>

            <li class="list-group-item">
                <strong>
                    <span class="badge badge-light mx-1">14.1</span>
                    Բուժման այլ տեսակներ
                </strong>
                <x-forms.prev-posts-link href='{{$route."#stationary_treatments"}}' />

                <div class="container">
                    <div class="col-md-12 my-2">
                        <x-forms.magic-search class="treatments-search" value='{{old("treatment_other_type_id")}}'
                            hidden-id="treatment_other_type_id" hidden-name="treatment_other_type_id"
                            placeholder="ընտրել բուժման տեսակը․․․" />
                    </div>

                    <div class="col-md-12 my-2">
                        <textarea name="treatment_other_type_comment" class="form-control"
                            placeholder="ազատ լրացման դաշտ․․․">{{old('treatment_other_type_comment')}}</textarea>
                    </div>
                </div>

                <hr class="hr-dashed">
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
                                    check="{{$stationary_tt->contains($item['id'])}}" /> <!-- old-default="$item['id']" -->
                                @endforeach

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </li>

            <li class="list-group-item">

                @if ($stationary_disability_certificates)
                <div class="collapse disability-certificates-collapse">
                    <strong>
                        <span class="badge badge-light mx-1">15.</span>
                        Նշումներ անաշխատունակության թերթիկ տրման մասին
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_disability_certificates"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disability-certificates-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @each('shared.forms.stationary_edit_sections.stationary_disability_certificates', $stationary_disability_certificates, 'item')
                </div>
                @endif

                <div class="collapse show disability-certificates-collapse">
                    <strong>
                        <span class="badge badge-light mx-1">15.</span>
                        Նշումներ անաշխատունակության թերթիկ տրման մասին
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_disability_certificates"}}' />

                    @if ($stationary_disability_certificates)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".disability-certificates-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="form-row align-items-center my-2">
                        <strong class="ml-2">
                            №
                        </strong>
                        <x-forms.text-field type="number" name="disability_certificate_number" class="col-sm-2 ml-2" label="" />
                        <x-forms.text-field type="date" name="disability_certificate_from" class="col-md-4 ml-2" label="" />
                        <em class="ml-2">
                            ից, մինչև
                        </em>
                        <x-forms.text-field type="date" name="disability_certificate_to" class="col-md-4 ml-2" label="" />
                    </div>
                </div>

            </li>

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

            <li class="list-group-item">

                @if ($stationary_expertise_conclusions)
                <div class="collapse expertise-conclusions-collapse">
                    <strong>
                        <span class="badge badge-light">18.</span>
                        Փորձաքննության ընդունվածների համար, եզրակացություն՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_expertise_conclusions"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".expertise-conclusions-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @forelse ($stationary_expertise_conclusions as $item)
                        <form action="{{ route('patients.stationary.expertise_conclusions') }}" class="ajax-submitable dont-reset" method="POST">
                            @method("PUT")
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <ul class="list-group mt-2">
                                <li class="list-group-item">
                                    <div class="col-sm-12">
                                        <x-forms.text-field type="textarea" validationType="ajax" class="mt-1" name="conclusion" placeholder="ազատ լրացման դաշտ․․․" value="{{ $item->conclusion }}" />
                                    </div>
                                </li>
                                @include('shared.forms.list_group_item_submit')
                            </ul>
                        </form>
                    @empty

                    @endforelse
                </div>
                @endif

                <div class="collapse show expertise-conclusions-collapse">
                    <strong>
                        <span class="badge badge-light">18.</span>
                        Փորձաքննության ընդունվածների համար, եզրակացություն՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_expertise_conclusions"}}' />

                    @if ($stationary_expertise_conclusions)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".expertise-conclusions-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <!-- conclusion of expertise -->
                    <div class="container">
                        <div class="col-md-12">
                            <textarea name="expertise_conclusion" class="form-control mt-2"
                                placeholder="ազատ լրացման դաշտ․․․">{{old('expertise_conclusion')}}</textarea>
                        </div>
                    </div>
                </div>

            </li>

            <li class="list-group-item">

                @if ($stationary_histological_examinations)
                <div class="collapse histological-examinations-collapse">
                    <strong>
                        <span class="badge badge-light">19.</span>
                        Հյուսվածքաբանական հետազոտության արդյունքը՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_histological_examinations"}}' />

                    <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".histological-examinations-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>

                    @forelse ($stationary_histological_examinations as $item)
                    <form action="{{ route('patients.stationary.update_histological_examinations') }}" class="ajax-submitable dont-reset" method="POST">
                        @method("PUT")
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <ul class="list-group mt-2">
                            <li class="list-group-item">
                                <div class="form-row align-items-center my-2 mx-2">
                                    <div class="col-md-6">
                                        <strong>ամսաթիվ</strong>
                                        <x-forms.text-field type="date" validationType="ajax" class="mt-1" name="examination_date" value="{{ $item->examination_date }}" />
                                    </div>
                                    <div class="col-md-6">
                                        <strong>եզրակացության համար №</strong>
                                        <x-forms.text-field type="number" validationType="ajax" class="mt-1" name="examination_number" value="{{ $item->examination_number }}" />
                                    </div>
                                </div>

                                <hr class="hr-dashed">
                                <div class="container">
                                    <x-forms.text-field type="textarea" validationType="ajax" class="mt-1" name="examination" placeholder="ազատ լրացման դաշտ․․․" value="{{ $item->examination }}" />
                                </div>
                            </li>
                            @include('shared.forms.list_group_item_submit')
                        </ul>
                    </form>
                    @empty

                    @endforelse
                </div>
                @endif

                <div class="collapse show histological-examinations-collapse">
                    <strong>
                        <span class="badge badge-light">19.</span>
                        Հյուսվածքաբանական հետազոտության արդյունքը՝
                    </strong>
                    <x-forms.prev-posts-link href='{{$route."#stationary_histological_examinations"}}' />

                    @if ($stationary_histological_examinations)
                        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".histological-examinations-collapse">
                            <x-svg icon="cui-pencil" />
                        </button>
                    @endif

                    <div class="form-row align-items-center my-2 mx-2">
                        <div class="col-md-6">
                            <strong>ամսաթիվ</strong>
                            <x-forms.text-field type="date" class="mt-1" name="histological_result_date" label="" />
                        </div>
                        <div class="col-md-6">
                            <strong>եզրակացության համար №</strong>
                            <x-forms.text-field type="number" class="mt-1" name="histological_result_number" label="" />
                        </div>
                    </div>

                    <hr class="hr-dashed">
                    <div class="container">
                        <textarea name="histological_result_comment" class="form-control"
                            placeholder="ազատ լրացման դաշտ․․․">{{old('histological_result_comment')}}</textarea>
                    </div>
                </div>

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

            <li class="list-group-item list-group-item-secondary">
                <button type="submit" class="btn btn-primary">Պահպանել մինչև 19-րդ կետի փոփոխությունները</button>
            </li>
        </ul>
</form>

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
@include('stationary.stationary_ultrasound_and_endoscopy', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_xray_examination', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_cellular_examination', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_expert_advice', ["patient" => $patient, "stationary" => $stationary ,'user'=> $user])

<hr class="my-4">
@include('stationary.stationary_for_analysis', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_surgery_justification', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_surgery_protocol', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_surgery_description', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_disease_course', [
"patient" => $patient,
"stationary" => $stationary,
"repeatables"=>$repeatables
])

<hr class="my-4">
@include('stationary.stationary_resuscitation_department', ["patient" => $patient, "stationary" => $stationary, 'user'
=> $user])

<hr class="my-4">
@include('stationary.stationary_epicrisis', ["patient" => $patient, "stationary" => $stationary])


<hr class="my-4">
@include('stationary.stationary_pathological_anatomical', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_special_note', ["patient" => $patient, "stationary" => $stationary])

<hr class="my-4">
@include('stationary.stationary_treatment_evaluation', ["patient" => $patient, "stationary" => $stationary])

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
</script>
@endsection
