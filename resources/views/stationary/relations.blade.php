@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>Ստացիոնար քարտ N {{ $stationary->number }} | Կոմպոնենտներ</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("patients.stationary.create", ["patient" => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
        <x-svg icon="cui-plus" />
        Նոր ստացիոնար քարտ
    </a>
</div>
@endsection

@section('card-content')

<table class="table table-striped table-bordered datatable-default">
    <thead>
        <tr>
            <th>Անվանում</th>
            <th>Լրացրել է</th>
            <th>Կարգավիճակ</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stationary->stationary_diagnoses as $diagnosis)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $diagnosis,
                "hashtag" => '#stationary_diagnosis_' . $diagnosis->diagnosis_type,
                "row_name" => __("enums.stationary_diagnosis_enum." . $diagnosis->diagnosis_type),
                "delete_route" => route('patients.stationary.delete_diagnoses')
            ])

        @endforeach

        @foreach ($stationary->stationary_medicine_side_effects as $med_side_effect)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $med_side_effect,
                "hashtag" => '#stationary_medicine_side_effect_' . $med_side_effect->type,
                "row_name" => __("enums.stationary_medicine_side_effect_enum." . $med_side_effect->type),
                "delete_route" => route('patients.stationary.delete_medicine_side_effects')
            ])

        @endforeach

        @foreach ($stationary->stationary_surgeries as $surgery)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $surgery,
                "hashtag" => "#stationary_surgeries",
                "row_name" => "Վիրահատություն - " . __("enums.stationary_surgery_enum." . $surgery->type),
                "delete_route" => route('patients.stationary.delete_surgeries')
            ])

        @endforeach

        @foreach ($stationary->stationary_treatments as $treatment)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $treatment,
                "hashtag" => "#stationary_treatments",
                "row_name" => "Բուժման այլ տեսակ (14.1)",
                "delete_route" => route('patients.stationary.delete_other_treatments')
            ])

        @endforeach

        @foreach ($stationary->stationary_disability_certificates as $certificate)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $certificate,
                "hashtag" => "#stationary_disability_certificates",
                "row_name" => "15. Նշում անաշխատունակության թերթիկ տրման մասին",
                "delete_route" => route('patients.stationary.delete_disability_certificates')

            ])

        @endforeach

        @foreach ($stationary->stationary_expertise_conclusions as $conclusion)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $conclusion,
                "hashtag" => "#stationary_expertise_conclusions",
                "row_name" => "18. Փորձաքնության ընդունվածների համար, եզրակացությունը",
                "delete_route" => route('patients.stationary.delete_expertise_conclusions')
            ])

        @endforeach

        @foreach ($stationary->stationary_histological_examinations as $examination)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $examination,
                "hashtag" => "#stationary_histological_examinations",
                "row_name" => "Հյուսվածաբանական հետազոտության արդյունքը",
                "delete_route" => route('patients.stationary.delete_histological_examinations')
            ])

        @endforeach

        @includeWhen(!is_null($stationary->stationary_primary_examination),
            'stationary.approvable_table_row',
            [
                "approvable" => $stationary->stationary_primary_examination,
                "hashtag" => "#primary-examination",
                "row_name" => "Առաջնային զննում",
                "delete_route" => route('patients.stationary.delete_primary_examination')
            ]
        )

        @includeWhen(!is_null($stationary->stationary_present_status),
            'stationary.approvable_table_row',
            [
                "approvable" => $stationary->stationary_present_status,
                "hashtag" => "#stationary-present-status",
                "row_name" => "Status praesens subjectivus et objecivus",
                "delete_route" => route('patients.stationary.delete_present_status')
            ]
        )

        @foreach ($stationary->stationary_ultrasound_endoscopies as $endoscopy)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $endoscopy,
                "hashtag" => "#us-endoscopy",
                "row_name" => "ՈւԼՏՐԱՁԱՅՆԱՅԻՆ ԵՎ ԷՆԴՈՍԿՈՊԻԿ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ",
                "delete_route" => route('patients.stationary.delete_ultrasound_endoscopy')
            ])

        @endforeach

        @foreach ($stationary->stationary_xray_examinations as $xray)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $xray,
                "hashtag" => "#xray-examinations",
                "row_name" => "ՌԵՆՏԳԵՆԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ",
                "delete_route" => route('patients.stationary.delete_xray_examination')
            ])

        @endforeach

        @foreach ($stationary->stationary_cellular_examinations as $cellular)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $cellular,
                "hashtag" => "#cellular-examination",
                "row_name" => "ԲՋՋԱԲԱՆԱԿԱՆ ՀԵՏԱԶՈՏՈՒԹՅՈՒՆ",
                "delete_route" => route('patients.stationary.delete_cellular_examination')
            ])

        @endforeach

        @foreach ($stationary->stationary_expert_advice as $advice)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $advice,
                "hashtag" => "#expert_advice",
                "row_name" => "ՄԱՍՆԱԳԵՏԻ ԽՈՐՀՐԴԱՏՎՈՒԹՅՈՒՆ",
                "delete_route" => route('patients.stationary.delete_expert_advice')
            ])

        @endforeach

        @foreach ($stationary->stationary_for_analysis as $analysis)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $analysis,
                "hashtag" => "#for_analysis",
                "row_name" => "ԱՆԱԼԻԶՆԵՐԻ ՀԱՄԱՐ",
                "delete_route" => route('patients.stationary.delete_for_analysis')
            ])

        @endforeach

        @foreach ($stationary->stationary_surgery_justifications as $surgery_justification)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $surgery_justification,
                "hashtag" => "#surgery-justification",
                "row_name" => "ՎԻՐԱՀԱՏՈՒԹՅԱՆ ՀԻՄՆԱՎՈՐՈՒՄ",
                "delete_route" => route('patients.stationary.delete_surgery_justification')
            ])

        @endforeach

        @foreach ($stationary->stationary_surgery_protocols as $surgery_protocol)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $surgery_protocol,
                "hashtag" => "#surgery-protocol",
                "row_name" => "ՎԻՐԱՀԱՏՈՒԹՅԱՆ ԱՐՁԱՆԱԳՐՈՒԹՅՈՒՆ",
                "delete_route" => route('patients.stationary.delete_surgery_protocol')
            ])

        @endforeach

        @foreach ($stationary->stationary_surgery_descriptions as $surgery_description)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $surgery_description,
                "hashtag" => "#stationary_surgery_descriptions",
                "row_name" => "Վիրահատության նկարագրություն",
                "delete_route" => route('patients.stationary.delete_surgery_description')
            ])

        @endforeach

        @foreach ($stationary->stationary_disease_courses as $disease_course)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $disease_course,
                "hashtag" => "#stationary_disease_course",
                "row_name" => "Հիվանդության ընթացքը",
                "delete_route" => route('patients.stationary.delete_disease_course')
            ])

        @endforeach

        @foreach ($stationary->stationary_resuscitation_departments as $resuscitation_department)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $resuscitation_department,
                "hashtag" => "#resuscitation-department",
                "row_name" => "ՎԵՐԱԿԵՆԴԱՆԱՑՄԱՆ ԲԱԺԱՆՄՈՒՆՔ",
                "delete_route" => route('patients.stationary.delete_resuscitation_department')
            ])

        @endforeach

        @includeWhen(!is_null($stationary->stationary_epicrisis),
            'stationary.approvable_table_row',
            [
                "approvable" => $stationary->stationary_epicrisis,
                "hashtag" => "#epicrisis",
                "row_name" => "ԷՊԻԿՐԻԶ",
                "delete_route" => route('patients.stationary.delete_epicrisis')
            ]
        )

        @includeWhen(!is_null($stationary->stationary_pathological_anatomical),
            'stationary.approvable_table_row',
            [
                "approvable" => $stationary->stationary_pathological_anatomical,
                "hashtag" => "#spa_diagnosis",
                "row_name" => "ԱԽՏԱԲԱՆԱ-ԱՆԱՏՈՄԻԱԿԱՆ ԱԽՏՈՐՈՇՈՒՄ",
                "delete_route" => route('patients.stationary.delete_pathological_anatomical')
            ]
        )

        @foreach ($stationary->stationary_special_note as $note)

            @include('stationary.approvable_table_row',
            [
                "approvable" => $note,
                "hashtag" => "#stationary_special_note",
                "row_name" => "ՀԱՏՈՒԿ ՆՇՈՒՄ",
                "delete_route" => route('patients.stationary.delete_special_note')
            ])

        @endforeach

        @includeWhen(!is_null($stationary->stationary_treatment_evaluation),
            'stationary.approvable_table_row',
            [
                "approvable" => $stationary->stationary_treatment_evaluation,
                "hashtag" => "#stationary_treatment_evaluation",
                "row_name" => "Հիվանդի վիճակի և բուժման գնահատում",
                "delete_route" => route('patients.stationary.delete_treatment_evaluation')
            ]
        )
    </tbody>
</table>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
@endsection
