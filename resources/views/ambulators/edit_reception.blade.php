@extends('layouts.cardBase')
@php
    $route = route('patients.ambulator.update', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_attendances = route('patients.ambulator.update_attendances', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_diagnosis = route('patients.ambulator.update_diagnosis', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_complaints = route('patients.ambulator.update_complaints', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_tnms = route('patients.ambulator.update_tnms', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_female_issues = route('patients.ambulator.update_female_issues', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_onset_and_developments = route('patients.ambulator.update_onset_and_developments', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_tumor_info = route('patients.ambulator.update_tumor_info', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_is_a_twin = route('patients.ambulator.update_is_a_twin', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_health_statuses = route('patients.ambulator.update_health_statuses', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_cancer_groups = route('patients.ambulator.update_cancer_groups', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_first_infos = route('patients.ambulator.update_first_infos', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_regis_date = route('patients.ambulator.update_regis_date', ["patient" => $patient, "ambulator" => $ambulator]);
    $route_harmfuls = route('patients.ambulator.update_harmfuls', ["patient" => $patient, "ambulator" => $ambulator]);

    $route_tnms_delete = route('ambulator.delete_tnms', ["ambulator" => $ambulator]);
    $route_diagnosis_delete = route('ambulator.delete_diagnosis', ["ambulator" => $ambulator]);
    $route_previous_diagnosis_delete = route('ambulator.delete_previous_diagnosis', ["ambulator" => $ambulator]);
    $route_attendances_delete = route('ambulator.delete_attendances', ["ambulator" => $ambulator]);
    $route_complaints_delete = route('ambulator.delete_complaints', ["ambulator" => $ambulator]);
    // $route_female_issues_delete = route('ambulator.delete_female_issues', ["ambulator" => $ambulator]);

    $route_oads_delete = route('ambulator.delete_onset_and_developments', ["ambulator" => $ambulator]);
    $route_tumor_info_delete = route('ambulator.delete_tumor_info', ["ambulator" => $ambulator]);
    $route_health_statuses_delete = route('ambulator.delete_health_statuses', ["ambulator" => $ambulator]);
    $route_hs_prescription_delete = route('ambulator.delete_hs_prescriptions', ["ambulator" => $ambulator]);
    $route_cancer_groups_delete = route('ambulator.delete_cancer_groups', ["ambulator" => $ambulator]);
    $route_first_infos_delete = route('ambulator.delete_first_infos', ["ambulator" => $ambulator]);
    // dd($route_hs_prescription_delete);

    $dummy_prescription = [
        'medicine_id' => null,
        'medicine_dose' => null,
        'measurement_unit_id' => null, // medicine_measure
        'prescription_text' => null,
    ];
@endphp

@section('css')
<link href="{{mix("/css/tail.select-default.css")}}" rel="stylesheet" />
<link href="{{mix("/css/jquery.magicsearch.min.css")}}" rel="stylesheet" />
@endsection

@section('card-header')
@section('card-header-classes', 'text-center')
<h5>{{$patient->all_names}}</h5>
<h3>Ամբուլատոր քարտ № <span>{{$ambulator->number}}</span></h3>
@endsection


@section('card-content')
Recetionsist
<ul class="list-group">
    <form action="{{$route_regis_date}}" class="ajax-submitable dont-reset" method="POST">
        @method('patch')
        @csrf
        <li class="list-group-item">
            <x-forms.text-field name="registration_date" value="{{$ambulator->registration_date ?? now()->format('Y-m-d')}}" type="date"
                label="Հաշվառման վերցնելու ամսաթիվ" validationType="ajax" />
        </li>
        @include('shared.forms.list_group_item_submit', [
            'btn_text' => 'փոփոխել',
        ])
    </form>
</ul>
<hr>

<ul class="list-group" id="ambulator_tnms">
    <li class="list-group-item">
        <strong>TNM
            <x-forms.prev-posts-link href='{{$route."#ambulator-tnms"}}'/>
        </strong>
        @if ($tnms->isNotEmpty())
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".tnms-collapse">
                <x-svg icon="cui-pencil" />
            </button>
        @endif
        <!-- create TNM -->
        <div class="collapse show tnms-collapse">
            <form action="{{$route_tnms}}" method="POST" class="ajax-submitable">
                @csrf
                @method('PATCH')
                <div class="form-row mt-2 px-3">
                    <div class="col-md-4">
                        <x-forms.select label="T" select-name='T' :options='$tCollectionJson'
                        validation-type='ajax' />
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="N" select-name='N' :options='$nCollectionJson'
                        validation-type='ajax' />
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="M" select-name='M' :options='$mCollectionJson'
                        validation-type='ajax' />
                    </div>
                </div>
                <div class="form-row mt-2 px-3">
                    <div class="col-md-4">
                        <x-forms.select label="Grade" select-name='Grade' :options='$gradeCollectionJson'
                        validation-type='ajax' />
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="L" select-name='L' :options='$lCollectionJson'
                        validation-type='ajax' />
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="V" select-name='V' :options='$vCollectionJson'
                        validation-type='ajax' />
                    </div>
                </div>
                <div class="form-row mt-2 px-3">
                    <div class="col-md-4">
                        <x-forms.select label="Ուռուցքի դասակարգում" select-name='pycmr' :options='$pycmrCollectionJson'
                        validation-type='ajax' />
                    </div>
                </div>

                <div class="col-md-12 my-2">
                    @include('shared.forms.list_group_item_submit', ['btn_text'=>'ավելացնել'])
                </div>
            </form>
        </div>

        <!-- update TNM -->
        <div class="collapse tnms-collapse">
            @forelse ($tnms as $tnm_key => $tnm)
            <form action="{{$route_tnms}}" method="POST" class="ajax-submitable" id="tnm_update_form_{{$tnm->id}}">
                <p>#{{$tnm_key + 1}}</p>
                @csrf
                @method('PATCH')
                <input type="hidden" name="tnm_id" value="{{$tnm->id}}">

                <div class="form-row mt-2 px-3">
                    <div class="col-md-4">
                        <x-forms.select label="T" select-name='T' :options='$tCollectionJson'
                        validation-type='ajax' value='{{$tnm->T}}' />
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="N" select-name='N' :options='$nCollectionJson'
                        validation-type='ajax' value='{{$tnm->N}}'/>
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="M" select-name='M' :options='$mCollectionJson'
                        validation-type='ajax' value='{{$tnm->M}}'/>
                    </div>
                </div>
                <div class="form-row mt-2 px-3">
                    <div class="col-md-4">
                        <x-forms.select label="Grade" select-name='Grade' :options='$gradeCollectionJson'
                        validation-type='ajax' value='{{$tnm->Grade}}'/>
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="L" select-name='L' :options='$lCollectionJson'
                        validation-type='ajax' value='{{$tnm->L}}'/>
                    </div>
                    <div class="col-md-4">
                        <x-forms.select label="V" select-name='V' :options='$vCollectionJson'
                        validation-type='ajax' value='{{$tnm->V}}'/>
                    </div>
                </div>
                <div class="form-row mt-2 px-3">
                    <div class="col-md-4">
                        <x-forms.select label="Ուռուցքի դասակարգում" select-name='pycmr' :options='$pycmrCollectionJson'
                        validation-type='session' value='{{$tnm->pycmr}}'/>
                    </div>
                </div>

                <div class="col-md-12 my-2">
                    @include('shared.forms.list_group_item_submit', [
                        'btn_text'=>'փոփոխել',
                        'delete_form_id' => "tnm_delete_form_{$tnm->id}",
                    ])
                </div>
            </form>
            <form action='{{$route_tnms_delete}}' method="POST" class="ajax-submitable" id="tnm_delete_form_{{$tnm->id}}">
                @csrf
                <input type="hidden" name="tnm_id" value='{{$tnm->id}}'>
                <input type="hidden" name="hide_form_id" value='tnm_update_form_{{$tnm->id}}'>
            </form>
            @empty
            @endforelse
        </div>
    </li>
</ul>
<hr>

<ul class="list-group" id="cancer_groups">

    <li class="list-group-item">
        <strong>
            Կլինիկական խումբ
            <x-forms.prev-posts-link href='{{$route."#cancer-groups"}}'/>
        </strong>
        @if ($patient->cancer_groups->isNotEmpty())
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".cancer-groups-collapse">
                <x-svg icon="cui-pencil" />
            </button>
        @endif
    </li>

    <!-- cancer_groups CREATE -->
    <div class="collapse cancer-groups-collapse show">
        <form action="{{$route_cancer_groups}}" method="POST" class="ajax-submitable-off">
            @csrf
            @method('PATCH')
            <input type="hidden" name="wrapper_id" value="#cancer_groups">
            <li class="list-group-item">
                <div class="col-md-12 my-2">
                    <select name="cancer_group_id" class="form-control without-search">
                        @foreach ($cancer_groups as $cancer_group)
                            <option value="{{$cancer_group->id}}">{{$cancer_group->name}}</option>
                        @endforeach
                    </select>
                    <em class="error text-danger" data-input="cancer_group_id"></em>
                </div>
            </li>
            @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
        </form>
    </div>

    <!-- cancer_groups UPDATE -->
    <div class="collapse cancer-groups-collapse">
        @forelse ($patient->cancer_groups as $pc_key => $item)
        {{-- @dump($pc_key)
        @dump($item->pivot->id) --}}
            <form action="{{$route_cancer_groups}}" method="POST" class="ajax-submitable dont-reset"
            id='cancer_group_update_form_{{$item->pivot->id}}'>
                @csrf
                @method('PATCH')
                <input type="hidden" name="pivot_id" value="{{$item->pivot->id}}"><!-- pivot-table-id -->
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        <p>#{{$pc_key+1}}</p>
                        <select name="cancer_group_id" class="form-control without-search">
                            @foreach ($cancer_groups as $cancer_group)
                                <option value="{{$cancer_group->id}}" {{($cancer_group->id === $item->id) ? 'selected':''}}>
                                    {{$cancer_group->name}}
                                </option>
                            @endforeach
                        </select>
                        <em class="error text-danger" data-input="cancer_group_id"></em>
                    </div>
                </li>

                @include('shared.forms.list_group_item_submit', [
                    'btn_text' => 'թարմացնել',
                    'delete_form_id' => "cancer_group_delete_form_{$item->pivot->id}",
                ])
            </form>
            <form action="{{$route_cancer_groups_delete}}" method="POST" class="ajax-submitable -off"
            id='cancer_group_delete_form_{{$item->pivot->id}}'>
                @csrf
                {{-- <input type="hidden" name="cancer_group_id" value='{{$item->id}}'> --}}
                <input type="hidden" name="pivot_id" value="{{$item->pivot->id}}">
                <input type="hidden" name="hide_form_id" value='cancer_group_update_form_{{$item->pivot->id}}'>
            </form>
        @empty
        @endforelse
    </div>
</ul>
<hr>

<ul class="list-group" id="patient_harmfuls">
    <li class="list-group-item">
        <strong>
            Վնասակար սովորություններ
            <x-forms.prev-posts-link href='{{$route."#patient-harmfuls"}}'/>
        </strong>
        {{-- @if ($patient->harmfuls->isNotEmpty())
            <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".patient-harmfuls-collapse">
                <x-svg icon="cui-pencil" />
            </button>
        @endif --}}
    </li>
    <form action="{{$route_harmfuls}}" class="ajax-submitable" method="POST">
        @csrf
        @method('patch')

        <li class="list-group-item">
            <select class="form-control with-search" name="harmfuls[]" multiple>
                @forelse ($harmfuls as $harmful)
                    <option value="{{$harmful->id}}"
                        @if ( $patient->harmfuls->pluck('id')->search($harmful->id) !== false )
                            selected
                        @endif
                    >{{$harmful->name}}</option>
                @empty
                @endforelse
            </select>
            <em class="error text-danger" data-input="harmfuls"></em>
        </li>
        @include('shared.forms.list_group_item_submit', [
            'btn_text' => 'թարմացնել',
        ])
    </form>

</ul>
<hr>


<ul class="list-group" id="first_info_section">
    <li class="list-group-item">
        <strong>
            Հիվանդը դիմել է առաջին անգամ
            <x-forms.prev-posts-link href='{{$route."#first-infos"}}' />
        </strong>

        @if ($patient->patient_first_infos->isNotEmpty())
        <button class="btn btn-primary btn-sm float-right" type="button"
            data-toggle="collapse" data-target=".first-infos-collapse">
            <x-svg icon="cui-pencil" />
        </button>
        @endif
    </li>


    <!-- first-info: CREATE  -->
    <div class="collapse show first-infos-collapse">
        <form action="{{$route_first_infos}}" method="POST" class="ajax-submitable-off">
            @csrf
            @method('PATCH')
            <input type="hidden" name="wrapper_id" value="#first_info_section">
            <li class="list-group-item">
                <h5>Հիվանդը դիմել է առաջին անգամ</h5>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label><strong>Որտեղ</strong></label>
                        <select class="form-control with-search" name="first_clinic">
                            @forelse ($clinics as $clinic)
                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('first_clinic')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="first_clinic_date" type="date" label="Երբ" />
                    </div>
                </div>

                <h5>Հիվանդությունը առաջին անգամ հայտնաբերվել է</h5>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label><strong>Որտեղ</strong></label>
                        <select class="form-control with-search" name="first_discovered">
                            @forelse ($clinics as $clinic)
                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('first_discovered')
                        <em class="error text-danger">{{$message}}</em>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <x-forms.text-field name="first_discovered_date" type="date" label="Երբ" />
                    </div>
                </div>

                <div class="form-group">
                    <x-forms.text-field name="past_treatments" type="textarea" label="Նախկինում ստացած բուժումներ"
                    placeholder="ազատ գրառման դաշտ" />
                </div>

            </li>
            @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
        </form>
    </div>

    <!-- first-info: UPDATE -->
    <div class="collapse first-infos-collapse">
        @foreach ($patient->patient_first_infos as $pfi_key => $first_info)
            <form action="{{$route_first_infos}}" method="POST" class="ajax-submitable dont-reset"
            id='first_info_update_form_{{$first_info->id}}'>
                @csrf
                @method('PATCH')
                <input type="hidden" name="first_info_id" value="{{$first_info->id}}">
                <li class="list-group-item">
                    <p>#{{$pfi_key + 1}}</p>
                    <h5>Հիվանդը դիմել է առաջին անգամ</h5>

                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label><strong>Որտեղ</strong></label>
                            <select class="form-control with-search" name="first_clinic">
                                @forelse ($clinics as $clinic)
                                    <option value="{{$clinic->id}}"
                                        @if ($first_info->first_clinic == $clinic->id)
                                            selected
                                        @endif
                                        >{{$clinic->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            <em class="error text-danger" data-input="first_clinic"></em>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <x-forms.text-field name="first_clinic_date" type="date" label="Երբ" value='{{$first_info->first_clinic_date}}' />
                        </div>
                    </div>

                    <h5>Հիվանդությունը առաջին անգամ հայտնաբերվել է</h5>
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label><strong>Որտեղ</strong></label>
                            <select class="form-control with-search" name="first_discovered">
                                @forelse ($clinics as $clinic)
                                    <option value="{{$clinic->id}}"
                                        @if ($first_info->first_discovered == $clinic->id)
                                            selected
                                        @endif
                                        >{{$clinic->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            <em class="error text-danger" data-input="first_discovered"></em>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <x-forms.text-field name="first_discovered_date" type="date" label="Երբ" value='{{$first_info->first_discovered_date}}' />
                        </div>
                    </div>

                </li>
                @include('shared.forms.list_group_item_submit', [
                    'btn_text' => 'թարմացնել',
                    'delete_form_id' => "first_info_delete_form_{$first_info->id}",
                ])
            </form>
            <form action="{{$route_first_infos_delete}}" method="POST" class="ajax-submitable"
            id='first_info_delete_form_{{$first_info->id}}'>
                @csrf
                <input type="hidden" name="first_info_id" value='{{$first_info->id}}'>
                <input type="hidden" name="hide_form_id" value='first_info_update_form_{{$first_info->id}}'>
            </form>
        @endforeach
    </div>

</ul>

@endsection

@section('javascript')
{{-- https://www.npmjs.com/package/tail.select --}}
<script src="{{mix('/js/select-pure.js')}}"></script>
<script src="{{mix('/js/components/Select.js')}}"></script>

<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script>
    const repeatables = @json($repeatables);

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
