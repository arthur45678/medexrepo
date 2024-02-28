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

<!-- session errors|success|warning|fail -->
{{-- @include('shared.info-box') --}}


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

    <ul class="list-group" id="preliminary_diagnosis">
        <li class="list-group-item">
            <strong>
                Նախնական ախտորոշում
                <x-forms.prev-posts-link href='{{$route."#preliminary_diagnosis"}}' />
            </strong>
            @if ($preliminary_diagnosis->user_id === auth()->id() || empty($preliminary_diagnosis->user_id))
            @php
                $pd_insert_form = 'pd_insert_form';
                $pd_delete_form = 'pd_delete_form';
            @endphp

            <form action="{{$route_diagnosis}}" method="POST" class="ajax-submitable dont-reset"
            id="{{$pd_insert_form}}">
                @csrf
                @method('PATCH')
                {{-- @dump($preliminary_diagnosis->id) --}}
                {{-- <input type="hidden" name="id" value="{{$preliminary_diagnosis->id}}"> --}}
                <input type="hidden" name="wrapper_id" value="#preliminary_diagnosis">
                <input type="hidden" name="type" value="{{$preliminary_diagnosis->type}}">
                <div class="col-md-12 my-2">
                    <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases"
                    hidden-id="preliminary_disease_id" hidden-name="disease_id" placeholder="Ընտրել ախտորոշումը․․․"
                    value='{{old("disease_id", $preliminary_diagnosis->disease_id)}}' />
                </div>
                <div class="col-md-12 my-2">
                    <x-forms.text-field type="date" name="diagnosis_date" validationType="ajax"
                    value='{{old("diagnosis_date",$preliminary_diagnosis->diagnosis_date)}}'/>
                </div>
                <div class="col-md-12 my-2">
                    <x-forms.text-field type="textarea" name="diagnosis_comment" placeholder="ազատ լրացման դաշտ․․․" validationType="ajax"
                    value='{{old("diagnosis_comment", $preliminary_diagnosis->diagnosis_comment)}}' />
                </div>
                <div class="col-md-12 my-2">
                    @include('shared.forms.list_group_item_submit', [
                        'btn_text'=>$preliminary_diagnosis->id ? 'փոփոխել' : 'ավելացնել',
                        'delete_form_id' => $preliminary_diagnosis->id ? $pd_delete_form : null,
                    ])
                </div>
            </form>
            <form action="{{$route_diagnosis_delete}}" method="POST" class="ajax-submitable" id='{{$pd_delete_form}}'>
                @csrf
                <input type="hidden" name="diagnosis_id" value="{{$preliminary_diagnosis->id?? null}}">
                <input type="hidden" name="reset_form_id" value="{{$pd_insert_form}}">
                <input type="hidden" name="reset_fields[]" value="diagnosis_date">
                <input type="hidden" name="reset_fields[]" value="diagnosis_comment">
                <input type="hidden" name="reset_fields[]" value="diagnosis_id">
                <input type="hidden" name="reset_fields[]" value="disease_id">
            </form>
            @else
                բժիշկ՝ {{$preliminary_diagnosis->user->full_name}}
            @endif
        </li>
    </ul>
    <hr>

    <ul class="list-group" id="final-diagnosis-section">
        <li class="list-group-item">
            <strong>
                Վերջնական ախտորոշում
                <x-forms.prev-posts-link href='{{$route."#final_diagnosis"}}' />
            </strong>
            @if ($final_diagnosis->user_id === auth()->id() || empty($final_diagnosis->user_id))
            @php
                $fnd_insert_form = 'fnd_insert_form';
                $fnd_delete_form = 'fnd_delete_form';
            @endphp

            <form action="{{$route_diagnosis}}" method="POST" class="ajax-submitable dont-reset" id='{{$fnd_insert_form}}'>
                @csrf
                @method('PATCH')
                {{-- @dump($final_diagnosis->id) --}}
                <input type="hidden" name="wrapper_id" value="#final-diagnosis-section">
                <input type="hidden" name="type" value="{{$final_diagnosis->type}}">
                <div class="col-md-12 my-2">
                    <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases"
                    hidden-id="final_disease_id" hidden-name="disease_id" placeholder="Ընտրել ախտորոշումը․․․"
                    value='{{old("disease_id", $final_diagnosis->disease_id)}}'/>
                </div>
                <div class="col-md-12 my-2">
                    <x-forms.text-field type="date" name="diagnosis_date" validationType="ajax"
                    value='{{old("diagnosis_date",$final_diagnosis->diagnosis_date)}}'/>
                </div>
                <div class="col-md-12 my-2">
                    <x-forms.text-field type="textarea" name="diagnosis_comment" placeholder="ազատ լրացման դաշտ․․․"
                    value='{{old("diagnosis_comment", $final_diagnosis->diagnosis_comment)}}' validationType="ajax" />
                </div>
                <div class="col-md-12 my-2">
                    @include('shared.forms.list_group_item_submit', [
                        'btn_text'=>$final_diagnosis->id ? 'փոփոխել' : 'ավելացնել',
                        'delete_form_id' => $final_diagnosis->id ? $fnd_delete_form : null,
                    ])
                </div>
            </form>
            <form action="{{$route_diagnosis_delete}}" method="POST" class="ajax-submitable" id='{{$fnd_delete_form}}'>
                @csrf
                <input type="hidden" name="diagnosis_id" value="{{$final_diagnosis->id?? null}}">
                <input type="hidden" name="reset_form_id" value="{{$fnd_insert_form}}">
                <input type="hidden" name="reset_fields[]" value="diagnosis_date">
                <input type="hidden" name="reset_fields[]" value="diagnosis_comment">
                <input type="hidden" name="reset_fields[]" value="diagnosis_id">
                <input type="hidden" name="reset_fields[]" value="disease_id">
            </form>

            @else
                բժիշկ՝ {{$final_diagnosis->user->full_name}}
            @endif
        </li>
    </ul>
    <hr>

    <ul class="list-group" id="previous-diagnosis-section">
        <li class="list-group-item">
            <!-- forms of updation -->
            @if ($previous_diagnoses->count())
                <div class="collapse previous-diagnoses-collapse">
                    <button class="btn btn-primary btn-sm float-right" type="button"
                        data-toggle="collapse" data-target=".previous-diagnoses-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                    @foreach ($previous_diagnoses as $pd_key => $item)
                        <strong>
                            Ինչ հիվանդություններով է հիվանդացել (#{{$pd_key + 1}})
                        </strong>
                        <div class="col-md-12">
                            @include('shared.forms.ambulator_edit_sections.ambulator_diagnoses', [
                                'item' => $item,
                                'included_action_route' => $route_diagnosis,
                                'included_form_method' => 'PATCH',
                                'included_submit_txt' => 'փոփոխել',
                                'has_hidden_type' => true,
                                'has_diagnosis_date' => true,
                                'route_delete' => $route_previous_diagnosis_delete
                            ])
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- form of creation -->
            <div class="collapse show previous-diagnoses-collapse">
                <strong>
                    Ինչ հիվանդություններով է հիվանդացել
                    <x-forms.prev-posts-link href='{{$route."#last_disease"}}' />
                </strong>

                @if ($previous_diagnoses->count())
                    <button class="btn btn-primary btn-sm float-right" type="button"
                        data-toggle="collapse" data-target=".previous-diagnoses-collapse">
                        <x-svg icon="cui-pencil" />
                    </button>
                @endif

            <form action="{{$route_diagnosis}}" method="POST" class="ajax-submitable dont-reset-off">
                @csrf
                @method('PATCH')
                <input type="hidden" name="type" value="previous">
                <input type="hidden" name="wrapper_id" value="#previous-diagnosis-section">
                <div class="col-md-12 my-2">
                    <x-forms.magic-search class="magic-search ajax" data-catalog-name="diseases"
                    hidden-id="disease_id" hidden-name="disease_id" placeholder="Ընտրել ախտորոշումը․․․"
                    value='{{old("disease_id")}}'/>
                </div>
                <div class="col-md-12 my-2">
                    <x-forms.text-field type="date" name="diagnosis_date" validationType="ajax"
                    value='{{old("diagnosis_date")}}'/>
                </div>
                <div class="col-md-12 my-2">
                    <x-forms.text-field type="textarea" name="diagnosis_comment" placeholder="ազատ լրացման դաշտ․․․"
                    value='{{old("diagnosis_comment")}}' validationType="ajax" />
                </div>
                <div class="col-md-12 my-2">
                    @include('shared.forms.list_group_item_submit', [
                        'btn_text'=>'ավելացնել'
                    ])
                </div>
            </form>
            </div>
        </li>
    </ul>
    <hr>

    @php
        $attendances_anchor = 'patient-attendances';
    @endphp
    <ul class="list-group" id='{{$attendances_anchor}}'>
        <li class="list-group-item" id="koko">
            <form action="{{$route_attendances}}" method="POST" class="ajax-submitable-off" id="att-date">
                @csrf
                @method('PATCH')
                <input type="hidden" name="anchor" value='{{$attendances_anchor}}'>
                <div class="form-row align-items-center my-2">
                    <div class="col-md-4"><h5>Հաճախումների հսկողություն</h5></div>
                    <div class="col-md-6">
                        <x-forms.text-field type="datetime-local" name="attendance_date" form="att-date" required/>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary float-right" type="submit" form="att-date">
                            <x-svg icon="cui-plus" />ավելացնել
                        </button>
                    </div>
                </div>
            </form>
            <small class="text-info">Հաճախման ամսաթիվ դաշտը պետք է լինի ամսաթիվ վաղվանից ոչ ուշ։</small>
            <hr class="hr-dashed">

            <div class="form-row">
                @forelse ($ambulator->attendances as $item)
                <div class="col-md-3 col-sm-6" id="att-card-{{$item->id}}">
                    <div class="card">
                        <div class="card-body p-1">
                            <input type="datetime-local" class="w-100 rounded" name="attendance_date"
                            value='{{date('Y-m-d\TH:i', strtotime($item->attendance_date))}}'
                            form="att_edit_{{$item->id}}" required>
                        </div>

                        @if (auth()->id() === $item->user_id)
                            <form action="{{$route_attendances}}" method="POST" class="ajax-submitable"
                            id="att_edit_{{$item->id}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="id" value='{{$item->id}}'>
                            </form>

                            <form action="{{$route_attendances_delete}}" method="POST" class="ajax-submitable"
                            id="att_delete_{{$item->id}}">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="hide_card_id" value='att-card-{{{$item->id}}}'>
                                <input type="hidden" name="id" value='{{$item->id}}'>
                            </form>

                            <div class="card-footer bg-light text-center">
                                <button class="btn btn-success btn-sm" form="att_edit_{{$item->id}}">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <x-svg icon="cui-save" />
                                </button>
                                <button class="btn btn-danger btn-sm" form="att_delete_{{$item->id}}">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <x-svg icon="cui-trash"/>
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </li>
    </ul>
    <hr>

    <ul class="list-group">
        <li class="list-group-item">
            <table class="table table-stripped table-bordered">
                <thead>
                <tr>
                    <th>Ստացիոնար ընդունման ամսաթիվը</th>
                    <th>Հիվանդության պատմություն №</th>
                    <th>Կատարված վիրահատության ամսաթիվը</th>
                    <th>Դուրս գրման ամսաթիվը</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($stationaries as $item)
                    @php
                        $s_route = route('patients.stationary.show', ["patient" => $patient, "stationary" => $item->stationary_id]);
                    @endphp
                    <tr>
                        <td>{{$item->admission_date}}</td>
                        <td class="text-center">
                            <span class="mr-3">{{$item->number}}</span>
                            <x-forms.prev-posts-link href='{{$s_route."#stationary_surgeries"}}' size='md' />
                        </td>
                        <td class="text-center">
                            <span class="mr-3">{{$item->surgery_date}}</span>
                            <x-forms.prev-posts-link href='{{$s_route."#stationary_surgeries"}}' size='md' />
                        </td>
                        <td>{{$item->discharge_date}}</td>
                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
        </li>
    </ul>
    <hr>

    <ul class="list-group" id="ambulator-complaint-section">
        <li class="list-group-item">
            <strong>
                Հիվանդի Գանգատներ
            </strong>
            <x-forms.prev-posts-link href='{{$route."#last_disease"}}' />
            @if ($complaints->isNotEmpty())
                <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".patient-complaints-collapse">
                    <x-svg icon="cui-pencil" />
                </button>
            @endif
        </li>
        <li class="list-group-item">
            <!-- create complaint -->
            <div class="show collapse patient-complaints-collapse" id="create-patient-complaints">
                <form action='{{$route_complaints}}' method="POST" class="ajax-submitable-off">
                    @csrf
                    @method('PATCH')
                    <div class="col-md-12 my-2">
                    <x-forms.text-field type="textarea" name="complaint_text" label="Գանգատի նկարագրություն" validationType="ajax"/>
                    </div>
                    <div class="col-md-12 my-2">
                    <x-forms.text-field type="date" class="mb-2" name="complaint_date" label="Գանգատի արձանագրման ամսաթիվ" validationType="ajax"/>
                    </div>
                    <div class="col-md-12 my-2">
                    @include('shared.forms.list_group_item_submit', ['btn_text'=>'ավելացնել'])
                    </div>
                </form>
            </div>

            <!-- update complaint -->
            <div class="collapse patient-complaints-collapse" id="update-patient-complaints">

                @forelse ($complaints as $c_key => $item)

                    <form action='{{$route_complaints}}' method="POST" class="ajax-submitable dont-reset"
                    id='complaint_update_form_{{$item->id}}'>
                        <p>#{{$c_key + 1}}</p>
                        <hr>

                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="complaint_id" value='{{$item->id}}'>
                        <div class="col-md-12 my-2">
                        <x-forms.text-field type="textarea" name="complaint_text" label="Գանգատի նկարագրություն"
                        value='{{$item->complaint_text}}' validationType="ajax"/>
                        </div>
                        <div class="col-md-12 my-2">
                        <x-forms.text-field type="date" name="complaint_date" label="Գանգատի արձանագրման ամսաթիվ"
                        value='{{$item->complaint_date}}' validationType="ajax"/>
                        </div>
                        <div class="col-md-12 my-2">
                        @include('shared.forms.list_group_item_submit', [
                            'btn_text'=>'թարմացնել',
                            'delete_form_id' => "complaint_delete_form_{$item->id}",
                            ])
                        </div>
                    </form>
                    <form action='{{$route_complaints_delete}}' method="POST" class="ajax-submitable"
                    id="complaint_delete_form_{{$item->id}}">
                        @csrf
                        <input type="hidden" name="complaint_id" value='{{$item->id}}'>
                        <input type="hidden" name="hide_form_id" value='complaint_update_form_{{$item->id}}'>
                    </form>
                @empty
                @endforelse
            </div>
        </li>
    </ul>
    <hr>

    <ul class="list-group" id="ambulator-female-issues">
        <li class="list-group-item list-group-item-info">
            <strong>
                Կանացի տվյալներ
                <x-forms.prev-posts-link href='{{$route."#ambulator-female-issues"}}' />
            </strong>
        </li>
        @php
            // եթե id-ն null-է, ուրեմն ավելացնել, կհռկ․ թարմացնել
            // dump($female_issues);
            $female_issues_btn_text = $female_issues->id ? 'թարմացնել' : 'ավելացնել';
        @endphp
        <form action="{{$route_female_issues}}" class="ajax-submitable-off" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="female_issues_id" value="{{$female_issues->id}}">
        <li class="list-group-item">
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <x-forms.text-field type="number" name="number_of_births" min="0" max="20"
                        value='{{old("number_of_births", $female_issues->number_of_births)}}' label="Ծննդաբերությունների թիվը"/>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <x-forms.text-field type="number" name="number_of_abortions"  min="0" max="20"
                        value='{{old("number_of_abortions", $female_issues->number_of_abortions)}}' label="Վիժումների թիվը"/>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <x-forms.text-field name="date_of_last_birth" type="date" label="Վերջին ծննդաբերության ամսաթիվը"
                value='{{old("date_of_last_birth", $female_issues->date_of_last_birth)}}' />
        </li>
        <li class="list-group-item">
            <x-forms.text-field name="breast_inflammation" type="textarea" label="Կրծքագեղձի բորբոքում"
            value='{{old("breast_inflammation", $female_issues->breast_inflammation)}}' />
        </li>
        <li class="list-group-item">
            <strong>Դաշտանը</strong>
            <div class="row mt-2">
                <div class="form-group col-sm-12 col-md-3">
                    <x-forms.text-field name="menstruation_date" type="date" label=""
                    value='{{old("menstruation_date", $female_issues->menstruation_date)}}' />
                </div>
                <div class="form-group col-sm-12 col-md-9">
                    <x-forms.text-field name="menstruation" type="textarea" placeholder="Ազատ լրացման դաշտ․․․"
                    value='{{old("menstruation", $female_issues->menstruation)}}' />
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <x-forms.text-field name="breastfeeding_complications" type="textarea" label="Բարդություններ կրծքով կերակրելու շրջանում"
            value='{{old("breastfeeding_complications", $female_issues->breastfeeding_complications)}}' />
        </li>
        @include('shared.forms.list_group_item_submit', ['btn_text' => $female_issues_btn_text])
    </form>
    </ul>
    <hr>

    <ul class="list-group" id="ambulator-oad-section">
        <li class="list-group-item">
            <strong>
                Հիվանդության հանդես գալը, զարգացումը
            </strong>
            <x-forms.prev-posts-link href='{{$route."#ambulator-onset-and-developments"}}' />
            @if ($oads->isNotEmpty())
                <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".ambulator-oad">
                    <x-svg icon="cui-pencil"/>
                </button>
            @endif
        </li>

        <!-- create oad -->
        <div class="ambulator-oad collapse show">
            <form action="{{$route_onset_and_developments}}" method="POST" class="ajax-submitable-off">
                @csrf
                @method('PATCH')
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        {{-- validationType="ajax" --}}
                        <x-forms.text-field name="oad_date" label="" type="date" validationType="ajax" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="oad_comment" label="" type="textarea" validationType="ajax" />
                    </div>
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
            </form>
        </div>

        <!-- update oad -->
        <div class="ambulator-oad collapse">
            @forelse ($oads as $oad_key => $oad)
                <form action="{{$route_onset_and_developments}}" method="POST" class="ajax-submitable dont-reset"
                id='oad_update_form_{{$oad->id}}'>
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="oad_id" value="{{$oad->id}}">
                    <li class="list-group-item">
                        <p>#{{$oad_key + 1}}</p>
                        <div class="col-md-12 my-2">
                            <x-forms.text-field name="oad_date" label="" type="date" validationType="ajax"
                                value='{{$oad->oad_date}}'/>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-md-12 my-2">
                            <x-forms.text-field name="oad_comment" label="" type="textarea" validationType="ajax"
                                value='{{$oad->oad_comment}}'/>
                        </div>
                    </li>
                    @include('shared.forms.list_group_item_submit', [
                        'btn_text' => 'թարմացնել',
                        'delete_form_id' => "oad_delete_form_{$oad->id}",
                    ])
                </form>
                <form action="{{$route_oads_delete}}" method="POST" class="ajax-submitable"
                id="oad_delete_form_{{$oad->id}}">
                    @csrf
                    <input type="hidden" name="oad_id" value='{{$oad->id}}'>
                    <input type="hidden" name="hide_form_id" value='oad_update_form_{{$oad->id}}'>
                </form>
            @empty
            @endforelse
        </div>
    </ul>
    <hr>

    <ul class="list-group" id="tumor-info-section">
        <li class="list-group-item">
            <strong>
                Ուռուցքի նկարագրություն, տեղակայումը՝
            </strong>
            <x-forms.prev-posts-link href='{{$route."#ambulator-tumor-infos"}}' />
            @if ($tumor_infos->isNotEmpty())
                <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".ambulator-tumor_info">
                    <x-svg icon="cui-pencil" />
                </button>
            @endif
        </li>

        <!-- create tumor_infos -->
        <div class="ambulator-tumor_info collapse show">
            <form action="{{$route_tumor_info}}" method="POST" class="ajax-submitable-off">
                @csrf
                @method('PATCH')
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        {{-- validationType="ajax" --}}
                        <x-forms.text-field name="tumor_date" label="" type="date" validationType="ajax" />
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="tumor_description" label="" type="textarea" validationType="ajax" />
                    </div>
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
            </form>
        </div>

        <!-- update tumor_infos -->
        <div class="ambulator-tumor_info collapse">
            @forelse ($tumor_infos as $ti_key => $tumor)
            <form action="{{$route_tumor_info}}" method="POST" class="ajax-submitable dont-reset"
            id='tumor_update_form_{{$tumor->id}}'>
                @csrf
                @method('PATCH')
                <input type="hidden" name="tumor_id" value="{{$tumor->id}}">
                <li class="list-group-item">
                    <p>#{{$ti_key + 1}}</p>
                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="tumor_date" label="" type="date" validationType="ajax"
                            value='{{$tumor->tumor_date}}'/>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="tumor_description" label="" type="textarea" validationType="ajax"
                            value='{{$tumor->tumor_description}}'/>
                    </div>
                </li>
                @include('shared.forms.list_group_item_submit', [
                    'btn_text' => 'թարմացնել',
                    'delete_form_id' => "tumor_delete_form_{$tumor->id}",
                ])
            </form>
            <form action="{{$route_tumor_info_delete}}" method="POST" class="ajax-submitable"
            id='tumor_delete_form_{{$tumor->id}}'>
                @csrf
                <input type="hidden" name="tumor_info_id" value='{{$tumor->id}}'>
                <input type="hidden" name="hide_form_id" value='tumor_update_form_{{$tumor->id}}'>
            </form>
            @empty
            @endforelse
        </div>
    </ul>
    <hr>

    <ul class="list-group">
        <li class="list-group-item">
            <strong>Երկվորյակ է հիվանդը, թե ոչ</strong>
        </li>
        <form action="{{$route_is_a_twin}}" method="POST" class="ajax-submitable dont-reset">
            @csrf
            @method('PATCH')
            <input type="hidden" name="ambulator_id" value="{{$ambulator->id}}">
            <li class="list-group-item">
                <div class="col-md-3">
                    <x-forms.checkbox-radio pos="align" id="planned-radio1" value="1" name="is_a_twin"
                        old-default="{{$ambulator->is_a_twin}}" label="Այո" />
                    <x-forms.checkbox-radio pos="align" id="planned-radio2" value="0" name="is_a_twin"
                        old-default="{{$ambulator->is_a_twin}}" label="Ոչ" />
                    @error('is_a_twin')
                    <em class="error text-danger">{{$message}}</em>
                    @enderror
                </div>
            </li>
            @include('shared.forms.list_group_item_submit', ['btn_text' => 'թարմացնել'])
        </form>
    </ul>
    <hr>

    <ul class="list-group">
        <li class="list-group-item" id="health-status-section">
            <strong>Հիվանդի Վիճակը, նշանակումները</strong>
            <x-forms.prev-posts-link href='{{$route."#ambulator-health-statuses"}}' />
            @if ($health_statuses->isNotEmpty())
                <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="collapse" data-target=".ambulator-health-statuses">
                    <x-svg icon="cui-pencil" />
                </button>
            @endif
        </li>



        <!-- create health-statuses START -->
        <div class="ambulator-health-statuses collapse show">
            <form action="{{$route_health_statuses}}" method="POST" class="ajax-submitable-off">
                @csrf
                @method('PATCH')
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="health_status_date" type="date"
                        label="Ներկայացել է" validationType="ajax" required/>
                    </div>

                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="health_status_text" type="textarea"
                        label="Վիճակը" validationType="ajax"/>
                    </div>


                    <div class="col-md-12 my-2">
                        <hr class="hr-dashed">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Նշանակումները</strong>
                                <x-forms.prev-posts-link href="{{ $route . '#ambulator-prescriptions' }}" size='md'/>

                                <x-forms.add-reduce-button type="add" data-row=".ambulator-prescription-row" />
                                <x-forms.add-reduce-button type="reduce" data-row=".ambulator-prescription-row" />
                                <x-forms.hidden-counter class="ambulator-prescription-rows" name="prescription_length" />
                            </li>
                            @for($i = 0; $i < $repeatables; $i++)
                            <li class="list-group-item ambulator-prescription-row {{ $i < old('prescription_length', 1) ? ' ' : 'd-none' }}">
                                <div class="my-2">
                                    <strong>դեղամիջոց՝</strong>
                                    <x-forms.magic-search class="medicines-search magic-search ajax"
                                    data-catalog-name="medicines"
                                    value='{{ old("prescription_medicine_id.$i") }}'
                                    hidden-id="prescription_medicine_id{{ $i }}" hidden-name="prescription_medicine_id[]"
                                    placeholder="Ընտրել դեղամիջոցը․․" />
                                </div>

                                <div class="form-row align-items-center my-2">
                                    <div class="col-md-6">
                                        <strong>Քանակ՝</strong>
                                        <x-forms.text-field type="number" name='prescription_medicine_dose[]' label=""
                                            value='{{ old("prescription_medicine_dose.$i") }}' validationType="ajax" min="0" step="0.1" />
                                    </div>
                                    <div class="col-md-6">
                                        <strong>չափման միավոր՝</strong>
                                        <select name="prescription_medicine_measure[]" class="form-control">
                                            <option value="">Ընտրել չափման միավորը․․․</option>

                                            @foreach ($measurement_units as $unit)
                                                <option value="{{$unit->id}}">{{__('measurement_units.'.$unit->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-3">

                                        <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                        value='{{ old("prescription_text.$i") }}' name="prescription_text[]"
                                        validationType="ajax" label="" />
                                    </div>
                                </div>
                            </li>
                            @endfor
                        </ul>
                    </div>
                </li>
                @include('shared.forms.list_group_item_submit', ['btn_text' => 'ավելացնել'])
            </form>
        </div>
        <!-- create health-statuses END -->

        <!-- update health-statuses: վերջում տեղափոխել ներքև -->
        @if ($health_statuses->isNotEmpty())
        <div class="ambulator-health-statuses collapse w-75 m-auto">
            @forelse ($health_statuses as $hs_key => $item)
            <form action="{{$route_health_statuses}}" method="POST" class="ajax-submitable dont-reset"
            id="hs_update_form_{{$item->id}}">
                <p>#{{$hs_key+1}}</p>
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $item->id }}">
                <li class="list-group-item">
                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="health_status_date" type="date"
                        value="{{  old('health_status_date', $item->health_status_date) }}"
                        label="Ներկայացել է" validationType="ajax"/>
                    </div>

                    <div class="col-md-12 my-2">
                        <x-forms.text-field name="health_status_text" type="textarea"
                        value="{{  old('health_status_text', $item->health_status_text) }}"
                        label="Վիճակը" validationType="ajax"/>
                    </div>

                    {{-- Նշանակումներ սկիզբ --}}
                    @php
                        $item_prescriptions = $item->prescriptions;
                        $prescription_length = count($item_prescriptions) < 1 ? 1 : count($item_prescriptions);
                        $size = max($repeatables, $prescription_length);
                        $item_prescriptions_pad = array_pad($item_prescriptions->toArray(),$size, $dummy_prescription);
                    @endphp

                    <div class="col-md-12 my-2">
                        <hr class="hr-dashed">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Նշանակումները</strong>
                                <!-- testing add/reduce -->
                                {{--
                                <button  data-row=".ambulator-prescription-{{$hs_key}}-row" onclick="add(event)" type="button">ADD</button>
                                <button  data-row=".ambulator-prescription-{{$hs_key}}-row" onclick="reduce(event)" type="button"  data-limit="{{$prescription_length}}">REDUCE</button>
                                --}}

                                <x-forms.add-reduce-button type="add" data-row=".ambulator-prescription-{{$hs_key}}-row" />
                                <x-forms.add-reduce-button type="reduce" data-row=".ambulator-prescription-{{$hs_key}}-row" data-limit="{{$prescription_length}}" />
                                <x-forms.hidden-counter class="ambulator-prescription-{{$hs_key}}-rows" name="prescription_length"  old='{{$prescription_length}}' />
                            </li>
                            @for($i = 0; $i < $repeatables; $i++)
                            @if ($item_prescriptions_pad[$i]['medicine_id'])

                                {{-- @dump($item_prescriptions_pad[$i] ?? 'yoga') --}}
                                {{-- <kbd>prescription id:</kbd><!-- remove hidden when testing --> --}}
                                <input type="hidden" name="prescription_id[]" value="{{$item_prescriptions_pad[$i]['id']}}">
                            @endif


                            <li class="list-group-item ambulator-prescription-{{$hs_key}}-row {{ $i < old('prescription_length', $prescription_length) ? ' ' : 'd-none' }}">

                                <div class="my-2">
                                    <strong>---------------- դեղամիջոց {{$i+1}}.՝ </strong>
                                    <x-forms.magic-search class="medicines-search magic-search ajax"
                                    data-catalog-name="medicines"
                                    value='{{ old("prescription_medicine_id.$i", $item_prescriptions_pad[$i]["medicine_id"]) }}'
                                    hidden-id="prescription_medicine_id_{{{$hs_key}}}_{{ $i }}_edit"
                                    hidden-name="prescription_medicine_id[]"
                                    placeholder="Ընտրել դեղամիջոցը․․" data-reset='hsp_{{$hs_key}}_{{$i}}'/>
                                </div>

                                <div class="form-row align-items-center my-2">
                                    <div class="col-md-6">
                                        <strong>Քանակ՝</strong>
                                        <x-forms.text-field type="number" name='prescription_medicine_dose[]' label=""
                                        value='{{ old("prescription_medicine_dose.$i", $item_prescriptions_pad[$i]["medicine_dose"]) }}'
                                        validationType="ajax" data-reset='hsp_{{$hs_key}}_{{$i}}' min="0" step="0.1" />
                                    </div>
                                    <div class="col-md-6">
                                        <strong>չափման միավոր՝</strong>
                                        <select name="prescription_medicine_measure[]" class="form-control" data-reset='hsp_{{$hs_key}}_{{$i}}'>
                                            <option value="">Ընտրել չափման միավորը․․․</option>

                                            @foreach ($measurement_units as $unit)
                                                <option value="{{$unit->id}}" {{$item_prescriptions_pad[$i]["measurement_unit_id"] === $unit->id ? 'selected' : '' }}>
                                                    {{__('measurement_units.'.$unit->name)}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <x-forms.text-field type="textarea" placeholder="դեղամիջոցի նշանակման աազատ դաշտ․․․"
                                        value='{{ old("prescription_text.$i", $item_prescriptions_pad[$i]["prescription_text"]) }}'
                                        name="prescription_text[]" validationType="ajax" label="" data-reset='hsp_{{$hs_key}}_{{$i}}'/>
                                    </div>
                                    <hr class="mb-2">
                                    @if ($item_prescriptions_pad[$i]['medicine_id'])
                                        @php
                                            $hsp_delete_form_id = "hsp_delete_form_{$item->id}_{$i}";
                                        @endphp
                                        <div class="col-md-12 mt-3" id="{{$hsp_delete_form_id}}">
                                                <input type="hidden" name="hs_prescription_id" value="{{$item_prescriptions_pad[$i]['id']}}" form="{{$hsp_delete_form_id}}">
                                                <input type="hidden" name="reset_form_id" value="{{$hsp_delete_form_id}}"  form="{{$hsp_delete_form_id}}">
                                                <input type="hidden" name="data_reset" value="hsp_{{$hs_key}}_{{$i}}"  form="{{$hsp_delete_form_id}}">

                                                @include('shared.forms.item_action_onclick', [
                                                    'btn_text' => 'Ջնջել նշանակումը',
                                                    'delete_form_id' => $hsp_delete_form_id,
                                                    'form_action' => $route_hs_prescription_delete
                                                ])
                                        </div>
                                    @endif
                                </div>
                            </li>
                            @endfor
                        </ul>
                    </div>


                </li>
                @include('shared.forms.list_group_item_submit', [
                    'btn_text' => 'փոփոխել',
                    'delete_form_id' => "hs_delete_form_{$item->id}",
                ])

            </form>
            <form action="{{$route_health_statuses_delete}}" method="POST" class="ajax-submitable"
            id="hs_delete_form_{{$item->id}}">
                @csrf
                <input type="hidden" name="health_status_id" value='{{$item->id}}'>
                <input type="hidden" name="hide_form_id" value='hs_update_form_{{$item->id}}'>
            </form>
            @empty
            @endforelse
        </div>
        @endif
    </ul>
    <hr>
@endsection

@section('javascript')
{{-- https://www.npmjs.com/package/tail.select --}}
<script src="{{mix('/js/select-pure.js')}}"></script>
<script src="{{mix('/js/components/Select.js')}}"></script>

<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/all.magicsearch.js') }}"></script>
<script>
    const repeatables = @json($repeatables);

    // for fast testing
    function add(event) {
        const $this = $(event.target);
        const rowClass = $this.data("row");
        const limit = $this.data("limit") || repeatables;
        // console.log("limit-", limit);
        // console.log($(rowClass).not(".d-none").next())
        $(rowClass)
            .not(".d-none")
            .last()
            .next()
            .removeClass("d-none");
        const rowsLength = $(rowClass + "s");
        const rowsLengthVal = Number(rowsLength.val());
        if (rowsLengthVal < limit) {
            rowsLength.val(rowsLengthVal + 1);
        }
        console.log("rowsLengthVal-", rowsLength.val());
    }

    function reduce(event) {
        const $this = $(event.target);
        const rowClass = $this.data("row");
        const limit = $this.data('limit');
        const min = limit || 1;
        // console.log('not-d-none-length->',$(rowClass).not('.d-none').length)
        if ($(rowClass).not(".d-none").length > min) {
            $(rowClass)
                .not(".d-none")
                .last()
                .addClass("d-none");
            const rowsLength = $(rowClass + "s");
            rowsLength.val(Number(rowsLength.val()) - 1);
            // console.log('rowsLength-reduce ->', rowsLength.val())
        }
    }

    // work with \views\shared\forms\item_action_onclick.blade.php
    function submit(event) {
        $this = $(event.target);
        console.log($this)
        const formId = $this.attr('form');
        console.log(formId)
        const inputs  = $('input[form='+formId+']');
        console.log(inputs)
        const requestData = inputs.get().reduce(function(fieldObject, input) {
            fieldObject[input.name] = input.value
            return fieldObject;
        },{});
        console.log(requestData)
        const formAction = $this.data('action');
        console.log(formAction)


        const $formElement = $(`#${formId}`);
        // $formElement.find(".alert").addClass("d-none");
        $formElement.find(".alert").css("display", "none");

        const postConsfig = {
            url: formAction,
            data: requestData,
            dataType:'json',
        }

        const postAjax = $.post(postConsfig);
        // done
        postAjax.done(function(resp) {
            console.log('done-success');
            console.log(resp)
            const {data = {}} = resp;
            console.log(data);
            const {dataReset = ''} = data;
            console.log(dataReset)

            if(dataReset) {
                $resetables = $(`[data-reset="${dataReset}"]`);
                console.log($resetables)
                $resetables.val('');

                $resetables.each( function(key, val){
                    if($(val).hasClass('magic-search') && $(val).data('hidden')) {
                        const dataHiddenId = $(val).data('hidden');
                        $(dataHiddenId).val(''); // magic-hidden-input
                    }
                })

            }

            const {resetFormId = ''} =  data;
            const {success:successMessage = ''} = data;
            const {hideResetForm = false} = data;
            if(resetFormId && successMessage) {
                const $resetForm = $(`#${resetFormId}`);

                if($resetForm.length){
                    $resetForm.find(".alert.alert-success")
                        // .removeClass("d-none")
                        .css("display", "block")
                        .find(".alert-content")
                        .text(successMessage);

                    if(hideResetForm) {
                        $resetForm.hide(1500);
                    }
                }
            }
        });

        // fail
        postAjax.fail(function(fail) {
            console.log(fail)
            const {responseJSON: {errors} = {}} = fail;
            console.log(errors);
            $formElement.find(".alert.alert-danger")
                    // .removeClass("d-none")
                    .css("display", "block")
                    .find(".alert-content")
                    // .text(err.responseJSON.message || "An error occured");
                    .text("Լրացված տվյալներն անվավեր են:");
        });

        // always
        postAjax.always(function(always) {
            //console.log( "complete" );
        });
    }

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
