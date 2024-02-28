@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ԲԻՔՍԻ ՄԱՆՐԷԱԶԵՐԾՄԱՆ ԳՐԱՆՑԱՄԱՏՅԱՆ</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.bix-sterilization-log.create", ["patient" => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
        <x-svg icon="cui-plus" />
        Նոր գրանցումներ
    </a>
</div>
@endsection

@section('card-content')

<table class="table table-striped table-bordered table-cursor datatable-default">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ամսաթիվ</th>
            <th>Բուժող բժիշկ</th>
            <th>Կարգավիճակ</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>


        @foreach ($posts as $item)

        <tr data-url="{{ route('samples.patients.bix-sterilization-log.show',['patient' => $patient, $item->id])}}">
            <td>
                {{ $item->id }}
            </td>
            <td>
                {{ $item->analysis_response_date }}
            </td>
            <td>
                {{ $item->general_nurse->full_name }}
            </td>
            <td>
                {{ optional($item->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $item->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.bix-sterilization-log.show',['patient' => $patient , $item->id])}}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $item)
                <a href="{{ route('samples.patients.bix-sterilization-log.edit',['patient' => $patient , $item->id])}}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('javascript')
<script src="{{ mix('js/jquery.js') }}"></script>
<script src="{{ mix('js/datatables.js') }}"></script>
@endsection
