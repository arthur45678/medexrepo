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
$stationary_social_packages = $user->stationary_social_packages;

$update_diagnosis = route('patients.stationary.update_diagnosis',  ["patient" => $patient, "stationary" => $stationary]);
$delete_reset_diagnoses = route('patients.stationary.delete_reset_diagnoses', ["stationary" => $stationary]);
$create_many_diagnoses = route('patients.stationary.create_many_diagnoses',  ["patient" => $patient, "stationary" => $stationary]);

$create_surgery = route('patients.stationary.create_surgery', ["patient" => $patient, "stationary" => $stationary]);

$create_other_treatment = route('patients.stationary.create_other_treatment', ["patient" => $patient, "stationary" => $stationary]);
$create_many_medicine_side_effects = route('patients.stationary.create_many_medicine_side_effects', ["patient" => $patient, "stationary" => $stationary]);
$create_histological_examination = route('patients.stationary.create_histological_examination', ["patient" => $patient, "stationary" => $stationary]);
$create_disability_certificate = route('patients.stationary.create_disability_certificate', ["patient" => $patient, "stationary" => $stationary]);
$create_expertise_conclusion =  route('patients.stationary.create_expertise_conclusion', ["patient" => $patient, "stationary" => $stationary]);
$create_social_package =  route('patients.stationary.create_social_package', ["patient" => $patient, "stationary" => $stationary]);
@endphp

@section('css')
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
<link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h5>Ստացիոնար հիվանդի</h5>
<h3>Բժշկական քարտ № <span>{{$stationary->number}}</span></h3>
@endsection

@section('card-content')
<div class="container">

        {{-- <button type="button" class="btn btn-lg btn-primary"
            style="position: fixed; bottom:20px; right:20px; z-index: 10">
            <x-svg icon="cui-file" />
        </button> --}}

        {{-- section needs
        1) $route
        2) $stationary_social_packages
        3) $create_social_package
        --}}
        @include('stationary.stationary_social_packages', [
            'route' => $route,
            'stationary_social_packages' => $stationary_social_packages,
            'create_social_package' => $create_social_package,
        ])

        {{-- section needs
        1) $route
        2) $primary_diagnosis
        3) $update_diagnosis_route
        4) $delete_reset_diagnoses_route
        --}}
        <hr class="hr-dashed">
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
                        <div class="align-items-center">
                            <div class="col-md-12">
                                <strong>Փուլը՝</strong>
                                <select name="stage" class="form-control with-search">
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
                                <x-forms.select label="T" select-name='T' :options='$tCollectionJson'
                                validation-type='session' value='{{$stationary->T}}' />
                            </div>
                            <div class="col-md-4">
                                <x-forms.select label="N" select-name='N' :options='$nCollectionJson'
                                validation-type='session' value='{{$stationary->N}}'/>
                            </div>
                            <div class="col-md-4">
                                <x-forms.select label="M" select-name='M' :options='$mCollectionJson'
                                validation-type='session' value='{{$stationary->M}}'/>
                            </div>
                        </div>

                        <div class="form-row mt-2 px-3">
                            <div class="col-md-4">
                                <x-forms.select label="Grade" select-name='Grade' :options='$gradeCollectionJson'
                                validation-type='session' value='{{$stationary->Grade}}'/>
                            </div>
                            <div class="col-md-4">
                                <x-forms.select label="L" select-name='L' :options='$lCollectionJson'
                                validation-type='session' value='{{$stationary->L}}'/>
                            </div>
                            <div class="col-md-4">
                                <x-forms.select label="V" select-name='V' :options='$vCollectionJson'
                                validation-type='session' value='{{$stationary->V}}'/>
                            </div>
                        </div>

                        <div class="form-row mt-2 px-3">
                            <div class="col-md-4">
                                <x-forms.select label="Ուռուցքի դասակարգում" select-name='pycmr' :options='$pycmrCollectionJson'
                                validation-type='session' value='{{$stationary->pycmr}}'/>
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
                    <hr class="hr-dashed">
                    <div class="form-row align-items-center">
                        <div class="col-md-4">
                            <strong>ՄԶԻ՝</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group align-items-center">
                                <input disabled class="form-control col-4" type="text" value="{{$stationary->mzi()}}">
                                <label class="ml-2" for="weight"><strong>կգ/մ²</strong></label>
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
</div>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script src="{{ mix('/js/components/Select.js')}}"></script>
<script src="{{mix('/js/select-pure.js')}}"></script>

<script>
    var repeatables = {{$repeatables}};
    var departments = {!! json_encode($departments) !!};
    var chambers = {!! json_encode($chambers) !!};
    var beds = {!! json_encode($beds) !!};

    var diseases = {!! json_encode($diseases) !!}
    var medicines = {!! json_encode($medicines) !!}

    $('.magic-search-diseases').magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: diseases, // "/catalogs/diseases.json",
            fields: ["name", "code"],
            id: "id",
            format: "%code% %name%",
            success: function($input, data) {
                const hidden_input_id = $input.data('hidden');
                $(hidden_input_id).val($input.attr("data-id"));
            }
        })
    );

    $(".magic-search-medicines").magicsearch(
        window.medexMagicSearch.assignConfigs({
            dataSource: medicines, // "/catalogs/medicines.json",
            fields: ["name", "code"],
            id: "id",
            format: "%code% %name%",
            success: function($input, data) {
                const hidden_id = $input.data("hidden");
                $(hidden_id).val($input.attr("data-id"));
            }
        })
    );

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
                scrollTop: jQuery(hash).offset().top - 140
            }, 200);
            // removing hash with '#' from url (wrpper_id: window.location.hash = '')
            var hashPos = window.location.href.search(hash);
            window.history.pushState({},'',window.location.href.slice(0, hashPos));
        }
    });
</script>
@endsection
