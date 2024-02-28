@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ՄԱՆՐԷԱԶԵՐԾՄԱՆ ՌԵԺԻՄ ՔՈՒՅՐ</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.sterilization-mode-sister.create", ['patient' => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($steril_list as $steril)
        <tr data-url="{{ route("samples.patients.sterilization-mode-sister.show", ['patient' => $patient , 'sterilization_mode_sister' => $steril]) }}">
            <td>
                {{ $steril->id }}
            </td>
            <td>
                {{ $steril->main_date}}
            </td>
            <td>
                {{-- {{ $steril->attending_doctor->full_name }} --}}
            </td>
            <td>
                {{ optional($steril->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $steril->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.sterilization-mode-sister.show', ['patient' => $patient , 'sterilization_mode_sister' => $steril]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $steril)
                <a href="{{ route('samples.patients.sterilization-mode-sister.edit', ['patient' => $patient , 'sterilization_mode_sister' => $steril]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $steril)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $steril->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm">
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                <form method="POST" action="{{route('samples.patients.sterilization-mode-sister.destroy', [$patient->id , $steril->id]) }}" class="d-inline">
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
