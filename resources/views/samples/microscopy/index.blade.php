@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ԷՐԻՏՐՈՑԻՏՆԵՐԻ ՄՈՐՖՈԼՈԳԻԱ</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.microscopy.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($mic_list as $mic)
        <tr data-url="{{ route("samples.patients.microscopy.show", ['patient' => $patient , 'Microscopy' => $mic]) }}">
            <td>
                {{ $mic->id }}
            </td>
            <td>
                {{ $mic->analysis_response_date }}
            </td>
            <td>
                {{ $mic->attending_doctor->full_name }}
            </td>
            <td>
                {{ optional($mic->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $mic->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.microscopy.show', ['patient' => $patient , 'Microscopy' => $mic]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $mic)
                <a href="{{ route('samples.patients.microscopy.edit', ['patient' => $patient , 'Microscopy' => $mic]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $mic)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $mic->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                <form method="POST" action="{{route('samples.patients.microscopy.destroy', [$patient->id , $mic->id]) }}" class="d-inline">
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
