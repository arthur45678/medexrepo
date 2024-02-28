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
            style="position: fixed; bottom:20px; right:20px; z-index: 10">
            <x-svg icon="cui-file" />
        </button> --}}

            <ul class="list-group text-center">
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


            <!------------------------------------------------------>
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
            </ul>
        <!-- 0-9 end -->


        <!-- 10-19 -->
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
                scrollTop: jQuery(hash).offset().top - 120
            }, 200);
            // removing hash with '#' from url (wrpper_id: window.location.hash = '')
            var hashPos = window.location.href.search(hash);
            window.history.pushState({},'',window.location.href.slice(0, hashPos));
        }
    });
</script>
@endsection
