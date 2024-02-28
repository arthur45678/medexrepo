@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ԱՆԵՍԹԵԶԻՈԼՈԳԻ ՆԱԽԱՎԻՐԱՀԱՏԱԿԱՆ ԶՆՆՈՒՄ</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.ape.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($apse_list as $apse)
        <tr data-url="{{ route("samples.patients.ape.show", ['patient' => $patient , $apse->id]) }}">
            <td>
                {{ $apse->id }}
            </td>
            <td>
                {{ $apse->date }}
            </td>
            <td>
                {{ $apse->attending_doctor->full_name}}
            </td>

            <td>
                {{ optional($apse->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $apse->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.ape.show', ['patient' => $patient , $apse->id]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $apse)
                <a href="{{ route('samples.patients.ape.edit', ['patient' => $patient , $apse->id]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan
                @if($apse->approvement)
                @can('user-can-approve', $apse)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $apse->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm" {{ $apse->approvement->status ? "disabled" : "" }}>
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan
                @endif
                @can('belongs-to-user', $apse)
                <form method="POST" action="{{route('samples.patients.ape.destroy', [$patient->id , $apse->id]) }}" class="d-inline">
                    @csrf
                    @method('delete')

                    <button class="btn btn-danger btn-sm"  >
                        <x-svg icon="cui-trash" />
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
