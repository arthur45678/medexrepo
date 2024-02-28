@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>ՄԱՆՐԷԱԲԱՆԱԿԱՆ ԼԱԲՈՐԱՏՈՐԻԱ</h4>
    <h5>{{ $patient->all_names }}</h5>
</div>
<div class="card-header-actions">
    <a href="{{ route("samples.patients.microbiology_examination_form_2.create", ['patient' => $patient, 'apse_list' => $apse_list]) }}" class="btn btn-primary float-right mr-4" type="button">
        <x-svg icon="cui-plus" />
        ԲԺՇԿԱԿԱՆ ՁԵՎ N 2
    </a>
</div>
@endsection

@section('card-content')

<table class="table table-striped table-bordered table-cursor datatable-default">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ամսաթիվ</th>
            <th>Հետազոտությունը իրականացնող բժիշկ</th>
            <th>Կարգավիճակ</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($apse_list as $apse)

        <tr data-url="{{ route("samples.patients.microbiology_examination_form_2.show", ['patient' => $patient , $apse->id]) }}">

            <td>
                {{ $apse->id }}
            </td>
            <td>
                {{ $apse->admission_date }}
            </td>
            <td>
                {{ isset($apse->attending_doctor) ? $apse->attending_doctor->full_name : '' }}
            </td>
            <td>

                {{ $apse->approvementStatus() }}
            </td>
            <td>


                <a href="{{ route("samples.patients.microbiology_examination_form_2.show", ['patient' => $patient , $apse->id]) }}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $apse)
                <a href="{{ route('samples.patients.microbiology_examination_form_2.edit', ['patient' => $patient, $apse->id]) }}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $apse)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $apse->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm" {{ $apse->approvement->status ? "disabled" : "" }}>
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                @if($apse->user_id == Auth::user()->id)
                    <form method="POST" action="{{route('samples.patients.microbiology_examination_form_2.destroy',['patient' => $patient,$apse->id]) }}" class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">
                            <x-svg icon="cui-trash"/>
                        </button>
                    </form>
                @endif

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
