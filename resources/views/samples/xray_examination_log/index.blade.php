@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>Ռենտգեն հետազոտությունների հաշվառման մատյան</h4>
    <h5>{{$patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.xray-examination-log.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
        <x-svg icon="cui-plus" />
        Նոր հետազոտություն
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
        @foreach ($xray_list as $xray)
        <tr data-url="{{ route("samples.patients.xray-examination-log.show", [$patient->id , $xray->id]) }}">
            <td>
                {{ $xray->id }}
            </td>
            <td>
                {{-- {{ $xray->biopsy_date}} --}}
            </td>
            <td>
                {{ $xray->attending_doctor->full_name }} <br>
                {{ $xray->examining_doctor->full_name }}
            </td>
            <td>
                {{ optional($xray->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $xray->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.xray-examination-log.show', [$patient->id , $xray->id]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $xray)
                <a href="{{ route('samples.patients.xray-examination-log.edit', [$patient->id , $xray->id]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $xray)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $xray->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                <form method="POST" action="{{route('samples.patients.xray-examination-log.destroy', [$patient->id , $xray->id]) }}" class="d-inline">
                    @csrf
                    @method('delete')

                    <button class="btn btn-danger btn-sm" >
                        <x-svg icon="cui-trash" />
                    </button>
                </form>
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
