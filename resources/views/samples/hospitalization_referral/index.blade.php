@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>Հոսպիտալացման ուղեգիր</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.hospitalization-referral.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($hr_list as $hr)
        <tr data-url="{{ route("samples.patients.hospitalization-referral.show", ['patient' => $patient , 'hospitalization_referral' => $hr]) }}">
            <td>
                {{ $hr->id }}
            </td>
            <td>
                {{ $hr->referral_date }}
            </td>
            <td>
                {{ $hr->attending_doctor->full_name }}
            </td>
            <td>
                {{ optional($hr->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $hr->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.hospitalization-referral.show', ['patient' => $patient , 'hospitalization_referral' => $hr]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $hr)
                <a href="{{ route('samples.patients.hospitalization-referral.edit', ['patient' => $patient , 'hospitalization_referral' => $hr]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $hr)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $hr->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                <form method="POST" action="{{route('samples.patients.hospitalization-referral.destroy', [$patient->id , $hr->id]) }}" class="d-inline">
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
