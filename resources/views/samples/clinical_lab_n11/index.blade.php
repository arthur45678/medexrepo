@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ԿԼԻՆԻԿԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ՁԵՎ N 11</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.clinical-lab-n11.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($cl_list as $cl)
        <tr data-url="{{ route("samples.patients.clinical-lab-n11.show", ['patient' => $patient , 'clinical_lab_n11' => $cl]) }}">
            <td>
                {{ $cl->id }}
            </td>
            <td>
                {{ $cl->biopsy_date}}
            </td>
            <td>
                {{ $cl->attending_doctor->full_name }}
            </td>
            <td>
                {{ optional($cl->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $cl->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.clinical-lab-n11.show', ['patient' => $patient , 'clinical_lab_n11' => $cl]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $cl)
                <a href="{{ route('samples.patients.clinical-lab-n11.edit', ['patient' => $patient , 'clinical_lab_n11' => $cl]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $cl)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $cl->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                <form method="POST" action="{{route('samples.patients.clinical-lab-n11.destroy', [$patient->id , $bl->id]) }}" class="d-inline">
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
