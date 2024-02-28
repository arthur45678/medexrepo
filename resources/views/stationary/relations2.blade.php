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
    @dump($stationary->stationary_epicrisis)
    {{-- @foreach ($stationary->stationary_medicine_side_effects as $diagnosis)
        @dump($diagnosis)
    @endforeach --}}

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
            @php
                // $approvable = !is_null($stationary->stationary_primary_examination);
            @endphp
            @includeWhen(!is_null($stationary->stationary_primary_examination),
                'stationary.approvable_table_row',
                [
                    "approvable" => $stationary->stationary_primary_examination,
                    // "approvement_status" => $stationary->stationary_primary_examination->approvementStatus(),
                    "hashtag" => "#primary-examination",
                    "row_name" => "Առաջնային զննում",
                    // "created_by" => $stationary->stationary_primary_examination->user->full_name
                ]
            )

            @includeWhen(!is_null($stationary->stationary_present_status),
                'stationary.approvable_table_row',
                [
                    "approvable" => $stationary->stationary_present_status,
                    "hashtag" => "#stationary-present-status",
                    "row_name" => "Status praesens subjectivus et objecivus",
                ]
            )

            @includeWhen(!is_null($stationary->stationary_epicrisis),
                'stationary.approvable_table_row',
                [
                    "approvable" => $stationary->stationary_epicrisis,
                    "hashtag" => "#epicrisis",
                    "row_name" => "ԷՊԻԿՐԻԶ",
                ]
            )
        </tbody>
    </table>
@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
@endsection
