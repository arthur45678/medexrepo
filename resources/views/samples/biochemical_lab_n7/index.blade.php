@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ԿԵՆՍԱՔԻՄԻԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ ԲԺՇԿԱԿԱՆ ՁԵՎ N 7</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.biochemical-lab-n7.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($bl_list as $bl)
        <tr data-url="{{ route("samples.patients.biochemical-lab-n7.show", ['patient' => $patient , 'biochemical_lab_n7' => $bl]) }}">
            <td>
                {{ $bl->id }}
            </td>
            <td>
                {{ $bl->biopsy_date}}
            </td>
            <td>
                {{ $bl->attending_doctor->full_name }}
            </td>
            <td>
                {{ optional($bl->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $bl->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.biochemical-lab-n7.show', ['patient' => $patient , 'biochemical_lab_n7' => $bl]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $bl)
                <a href="{{ route('samples.patients.biochemical-lab-n7.edit', ['patient' => $patient , 'biochemical_lab_n7' => $bl]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $bl)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $bl->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm" {{ $bl->approvement->status ? "disabled" : "" }}>
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                <form method="POST" action="{{route('samples.patients.biochemical-lab-n7.destroy', [$patient->id , $bl->id]) }}" class="d-inline">
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
