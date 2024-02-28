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
    <a href="{{ route("samples.patients.erythrocyte-morphology.create", ["patient" => $patient]) }}" class="btn btn-primary float-right mr-4" type="button">
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
        @foreach ($em_list as $em)
        <tr data-url="{{ route('samples.patients.erythrocyte-morphology.show',['patient' => $patient , 'erythrocyte_morphology' => $em])}}">
            <td>
                {{ $em->id }}
            </td>
            <td>
                {{ $em->analysis_response_date }}
            </td>
            <td>
                {{ $em->attending_doctor->full_name }}
            </td>
            <td>
                {{ optional($em->approvement)->status  ? "Հաստատված" : "Սպասման մեջ"}}
                {{ $em->approvementStatus() }}
            </td>
            <td>
                <a href="{{ route('samples.patients.erythrocyte-morphology.show',['patient' => $patient , 'erythrocyte_morphology' => $em])}}" class="btn btn-info btn-sm">
                    <x-svg icon="cui-external-link" />
                </a>

                @can('belongs-to-user', $em)
                <a href="{{ route('samples.patients.erythrocyte-morphology.edit',['patient' => $patient , 'erythrocyte_morphology' => $em])}}" class="btn btn-primary btn-sm">
                    <x-svg icon="cui-pencil" />
                </a>
                @endcan

                @can('user-can-approve', $em)
                <form method="POST" action="{{ route("approvements.update", ["approvement" => $em->approvement]) }}" class="d-inline">
                    @csrf
                    @method("PATCH")
                    <button class="btn btn-success btn-sm" {{ $em->approvement->status ? "disabled" : "" }}>
                        <x-svg icon="cui-check" />
                    </button>
                </form>
                @endcan

                <form method="POST" action="{{route('samples.patients.erythrocyte-morphology.destroy', [$patient->id , $em->id]) }}" class="d-inline">
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
