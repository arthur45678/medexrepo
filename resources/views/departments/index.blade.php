@extends('layouts.cardBase')

@section('css')
<link href="{{ mix('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
@endsection

@section('card-header')
<div>
    <h4>Բաժիններ</h4>
</div>
<div class="card-header-actions">
    {{-- @can('create departments')
    <a href="{{ route("catalogs.departments.create") }}" class="btn btn-primary float-right mr-4" type="button" target="_blank">
        <x-svg icon="cui-plus" />
        Նոր Բաժին
    </a>
    @endcan --}}
</div>
@endsection

@section('card-content')

    @can('dep_virahatakan_bajanmunq')
        <h3>dep_virahatakan_bajanmunq</h3>
    @endcan

<table class="table table-striped table-bordered datatable-default">
    <thead>
        <tr>
            <th>ID</th>
            <th>Անվանում</th>
            <th>Բաշխումը</th>
            <th>Հաստատումը</th>
            <th>Գործողություններ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
        <tr>
            <td>
                {{ $department->id }}
            </td>
            <td>
                {{ $department->name }}
            </td>
            <td>
                @if ( $department->closed_from_outside)
                    կենտրոնացված
                @else
                    ազատ
                @endif
            </td>
            <td>
                @if ( $department->closed_from_inside)
                    կենտրոնացված
                @else
                    անհատական
                @endif
            </td>
            <td>
                @if ($department_connections->contains($department->id))
                    <div class="text-center">
                        <a href='{{route("departments.users", compact("department"))}}' target='_blank' class="btn btn-primary">Բժիշկներ</a>
                        <a href='{{route("departments.patients", compact("department"))}}' target='_blank' class="btn btn-primary">Հիվանդներ</a>
                    </div>
                @else
                    <div class="text-center"> --- </div>
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
