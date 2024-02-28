@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>Իրազեկման թերթիկ</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.awareness-sheet.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($as_list as $as)
        <tr data-url="{{ route("samples.patients.awareness-sheet.show", ['patient' => $patient , 'awareness_sheet' => $as]) }}">
            <td>
                {{ $as->id }}
            </td>
            <td>
                {{ $as->first_date }}
            </td>
            <td>
                {{ $as->department_head->full_name}}
            </td>
            <td>
                {{ optional($as->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $as->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.awareness-sheet.show', ['patient' => $patient , 'awareness_sheet' => $as]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $as)
                <a href="{{ route('samples.patients.awareness-sheet.edit', ['patient' => $patient , 'awareness_sheet' => $as]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $as)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $as->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        <x-svg icon="cui-check" />
                    </button>
                </form>
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
